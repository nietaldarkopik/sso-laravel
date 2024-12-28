<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Raysulkobir\ZktecoLaravel\Lib\ZKTeco;
use Laradevsbd\Zkteco\Http\Library\ZktecoLib;
use App\DataTables\AbsensiAttendencesDataTable;
use App\Models\AbsensiAttendenceModel;
use App\Models\AbsensiUserModel;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use DB;

class DashboardController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Contracts\Support\Renderable
	 */
	public function index(Request $request)
	{
		
		$startDate = $request->input('start_date', now()->startOfMonth()->toDateString());
		$endDate = $request->input('end_date', now()->endOfMonth()->toDateString());
		$q = DB::table('absensi_users')
				->join('absensi_attendences', 'absensi_users.id', '=', 'absensi_attendences.id_user')
				->select(
					DB::raw("SUM(CASE WHEN TIME(absensi_attendences.datang) < '09:00:00' THEN 1 ELSE 0 END) as datang_awal"),
					DB::raw("SUM(CASE WHEN TIME(absensi_attendences.datang) BETWEEN '09:00:00' AND '09:20:00' THEN 1 ELSE 0 END) as tepat_waktu"),
					DB::raw("SUM(CASE WHEN TIME(absensi_attendences.datang) > '09:20:00' THEN 1 ELSE 0 END) as terlambat"),
				)
				->where('absensi_attendences.tanggal', 'like', date("Y-m-d"));

		$pieToday = $q->first();
		$q = DB::table('absensi_users')
				->join('absensi_attendences', 'absensi_users.id', '=', 'absensi_attendences.id_user')
				->select(
					DB::raw("SUM(CASE WHEN TIME(absensi_attendences.datang) < '09:00:00' THEN 1 ELSE 0 END) as datang_awal"),
					DB::raw("SUM(CASE WHEN TIME(absensi_attendences.datang) BETWEEN '09:00:00' AND '09:20:00' THEN 1 ELSE 0 END) as tepat_waktu"),
					DB::raw("SUM(CASE WHEN TIME(absensi_attendences.datang) > '09:20:00' THEN 1 ELSE 0 END) as terlambat"),
				)
				->whereBetween('absensi_attendences.tanggal', [$startDate, $endDate]);

		$pieMonth = $q->first();
		return view('vendor.adminlte.dashboard', compact('pieToday', 'pieMonth'));
	}

	public function getAttendanceRecaps(Request $request)
	{
		if ($request->ajax()) {
			$startDate = $request->input('start_date', now()->startOfMonth()->toDateString());
			$endDate = $request->input('end_date', now()->endOfMonth()->toDateString());

			$columns = [
				'absensi_users.id',
				'absensi_users.nama',
				'datang_awal',
				'tepat_waktu',
				'terlambat',
				'jumlah_hari_masuk',
				'total_jam_masuk',
				'overtime_days',
				'overtime_hours',
				/* 'DB::raw("COUNT(absensi_attendences.id)"), // jumlah_hari_masuk'
				'DB::raw("SUM(TIMESTAMPDIFF(SECOND, absensi_attendences.datang, absensi_attendences.pulang) / 3600)"), // total_jam_masuk'
				'DB::raw("SUM(CASE WHEN TIME(absensi_attendences.datang) < '09:00:00' THEN 1 ELSE 0 END)"), // datang_awal'
				'DB::raw("SUM(CASE WHEN TIME(absensi_attendences.datang) BETWEEN '09:00:00' AND '09:20:00' THEN 1 ELSE 0 END)"), // tepat_waktu'
				'DB::raw("SUM(CASE WHEN TIME(absensi_attendences.datang) > '09:20:00' THEN 1 ELSE 0 END)"), // terlambat'
				'DB::raw("SUM(GREATEST(TIMESTAMPDIFF(SECOND, absensi_attendences.datang, absensi_attendences.pulang) / 3600 - 8, 0))"), // overtime' */
			];
		
			$q = DB::table('absensi_users')
				->join('absensi_attendences', 'absensi_users.id', '=', 'absensi_attendences.id_user')
				->select(
					'absensi_users.id as id_user',
					'absensi_users.nama as nama',
					DB::raw("SUM(CASE WHEN TIME(absensi_attendences.datang) < '09:00:00' THEN 1 ELSE 0 END) as datang_awal"),
					DB::raw("SUM(CASE WHEN TIME(absensi_attendences.datang) BETWEEN '09:00:00' AND '09:20:00' THEN 1 ELSE 0 END) as tepat_waktu"),
					DB::raw("SUM(CASE WHEN TIME(absensi_attendences.datang) > '09:20:00' THEN 1 ELSE 0 END) as terlambat"),
					DB::raw("COUNT(absensi_attendences.id) as jumlah_hari_masuk"),
					DB::raw("SUM(TIMESTAMPDIFF(SECOND, absensi_attendences.datang, absensi_attendences.pulang) / 3600) as total_jam_masuk"),
					DB::raw("COUNT(CASE WHEN (TIMESTAMPDIFF(SECOND, absensi_attendences.datang, absensi_attendences.pulang) / 3600) > 8 THEN 1 ELSE 0 END) as overtime_days"),
					DB::raw("SUM(CASE WHEN (TIMESTAMPDIFF(SECOND, absensi_attendences.datang, absensi_attendences.pulang) / 3600) > 8 then GREATEST(TIMESTAMPDIFF(SECOND, absensi_attendences.datang, absensi_attendences.pulang) / 3600, 0) - 8 else 0 END) as overtime_hours"),
				)
				->whereBetween('absensi_attendences.tanggal', [$startDate, $endDate])
				->groupBy('absensi_users.id', 'absensi_users.nama');

			// Handle sorting
			if ($request->has('order')) {
				$columnIndex = $request->input('order.0.column'); // Index kolom yang diurutkan
				$sortDirection = $request->input('order.0.dir'); // ASC atau DESC
				$column = $columns[$columnIndex];

				$q->orderByRaw("$column $sortDirection");
			}
			return DataTables::of($q)
				->addIndexColumn() // Menambahkan kolom indeks
				->make(true);
		}
	}

	public function getAttendances(Request $request)
	{
		if ($request->ajax()) {
			$q = AbsensiAttendenceModel::select('id', 'id_user', 'tanggal', 'datang', 'pulang', 'id_device', 'device_no', 'user_no');

			$q->where('tanggal', 'like', date("Y-m-d"));

			$columns = $request->columns ?? [];
			$q->where(function ($query) use ($columns) {
				if (count($columns) > 0) {
					foreach ($columns as $i => $c) {
						if (!in_array($c['data'], ['DT_RowIndex']) && isset($c['search'])) {
							$query->orWhere($c['data'], 'like', '%' . $c['search']['value'] . '%');
						}
					}
				}
			});

			if ($request->has('start_date') && $request->has('end_date') && !empty($request->input('start_date')) && !empty($request->input('end_date'))) {
				$q->where(function ($query) use ($request) {
					$query->whereBetween('tanggal', [$request->start_date, $request->end_date]);
				});
			}

			if ($request->has('id_device') && $request->input('id_device') != '') {
				$q->where('id_device', $request->input('id_device'));
			}

			if ($request->has('id_user') && $request->input('id_user') != '') {
				$q->where('id_user', $request->input('id_user'));
			}


			return DataTables::of($q)
				//->setRowId('id')
				->addIndexColumn() // Tambahkan nomor index
				->editColumn('id_device', function (AbsensiAttendenceModel $data) {
					return ($data->device->device_name ?? '') . ' / ' . ($data->device->sn ?? '') . ' / ' . ($data->device->location ?? '');
				})
				->editColumn('id_user', function (AbsensiAttendenceModel $data) {
					return '<strong>' . ($data->user->nama ?? '') . '</strong> <br/> ' . ($data->user->jabatan ?? '');
				})
				->rawColumns(['id_device', 'id_user']) // Untuk mendukung HTML pada kolom status
				->make(true);
		}
	}
}
