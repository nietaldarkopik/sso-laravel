<?php

namespace App\DataTables;

use App\Models\Absensi;
use App\Models\AbsensiAttendenceModel;
use App\Models\AbsensiUserModel;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Http\Request;
use Storage;
use DB;
use Carbon\Carbon;

class AbsensiLaporansDataTable extends DataTable
{
    //protected $actions = ['print', 'excel'];

    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query, Request $request): EloquentDataTable
    {
		/* ->addColumn('action', 'vendor.adminlte.absensi-users.datatables_action') */
        return (new EloquentDataTable($query))
            ->addColumn('id_device', function (AbsensiUserModel $content) {
                return '<strong>' . ($content->device->device->device_name ?? '') . '</strong>' . ' <br/> ' . ($content->device->device->location ?? '');
            })
            ->addColumn('id_user', function (AbsensiUserModel $content) {
                return '<strong>'.($content->user->nama ?? $content->nama ?? '') . '</strong><br>' . ($content->user->jabatan ?? $content->jabatan ?? '');
            })
            ->addColumn('total_jam', function (AbsensiUserModel $content) {
				$startDate = Carbon::parse($content->datang);
				$endDate = Carbon::parse($content->pulang);
		
				$totalHours = $startDate->diffInHours($endDate);
                return $totalHours;
            })
            ->addColumn('total_hari', function (AbsensiUserModel $content) {
                return $content->total_hari;
            })
			/* 
            ->addColumn('tanggal', function (AbsensiUserModel $content) {
                return \Carbon\Carbon::parse($content->tanggal)->translatedFormat('Y/M/d');
            })
            ->addColumn('datang', function (AbsensiUserModel $content) {
                return \Carbon\Carbon::parse($content->datang)->translatedFormat('H:i:s');
            })
            ->addColumn('pulang', function (AbsensiUserModel $content) {
                return \Carbon\Carbon::parse($content->pulang)->translatedFormat('H:i:s');
            }) */
			->rawColumns(['action','id_user','id_device'])
            /* ->editColumn('kategori', function (AbsensiUserModel $jenispsu) {
                return $jenispsu->getKategori()->first()?->title;
            }) *//* 
            ->filterColumn('kategori', function ($query, $keywords) use ($request) {
                $query->where('kategori','like','%'.$keywords.'%');
            }) */
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(AbsensiUserModel $model,Request $request): QueryBuilder
    {
        //$q =  $model->newQuery()->rightJoin('absensi_users','absensi_users.id','=', 'absensi_attendences.id_user');
        $q =  $model->newQuery()->select(DB::raw('absensi_attendences.*,absensi_users.*'))
								->leftJoin('absensi_attendences',function($join) use ($request) {
									$join->on('absensi_users.id','=', 'absensi_attendences.id_user');
								});
        
        $columns = $request->columns ?? [];
        $q->where(function($query) use ($columns) {
            if (count($columns) > 0) {
                foreach ($columns as $i => $c) {
                    if (isset ($c['search'])) {
                        $query->orWhere($c['data'], 'like', '%'.$c['search']['value'].'%');
                    }
                }
            }
        });

		if ($request->has('start_date') && $request->has('end_date') && !empty($request->input('start_date')) && !empty($request->input('end_date'))) {
			$join->where(function($query) use ($request){
				$query->whereBetween('tanggal', [$request->start_date, $request->end_date]);
				if ($request->has('jenis') && $request->input('jenis') == 'hadir') {
					$q->orWhereNotNull('absensi_attendences.id');
				}else{
					$q->orWhereNull('absensi_attendences.id');
				}
			});
		}

        if ($request->has('id_device') && $request->input('id_device') != '') {
            $q->where('id_device', $request->input('id_device'));
        }

        if ($request->has('id_user') && $request->input('id_user') != '') {
            $q->where('absensi_users.id', $request->input('id_user'));
        }

		//echo $q->toSql();
        return $q;
        //return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('absensi-users-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bftip')
            ->orderBy(2)
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
                /* Button::make('reset'),
                Button::make('reload'),
                Button::make('searchPanes'), */
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            /* Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'), */
            //Column::make('districts.id'),
            Column::make('row_number')
            ->title('#')
            ->render('meta.row + meta.settings._iDisplayStart + 1;')
            ->width(50)
            ->orderable(false)
            ->searchable(false),
			Column::make('id_device')->title('Device / Lokasi')->searchable(true),
			Column::make('id_user')->title('Karyawan')->searchable(true),
			Column::make('tanggal')->title('Tanggal')->searchable(true),
			Column::make('datang')->title('Datang')->searchable(true),
			Column::make('pulang')->title('Pulang')->searchable(true),
			Column::make('total_jam')->title('Total Jam')->searchable(true),
			Column::make('total_hari')->title('Total Hari')->searchable(true),
			/* Column::make('device_no')->title('Device No')->searchable(true), */
			/* Column::make('user_no')->title('User No')->searchable(true), */
			
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'AbsensiAttendences_' . date('YmdHis');
    }

}
