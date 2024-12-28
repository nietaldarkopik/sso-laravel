<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\AbsensiDeviceUserModel;
use App\Models\AbsensiDeviceModel;
use App\DataTables\AbsensiDeviceUsersDataTable;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use DB;
use Auth;
use Illuminate\Support\Facades\Response;
use Str;
use PDF;

class AbsensiDeviceUserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware(['permission:role-list|role-create|role-edit|role-delete'], ['only' => ['index', 'store']]);
        //$this->middleware(['permission:role-create'], ['only' => ['create', 'store']]);
        //$this->middleware(['permission:role-edit'], ['only' => ['edit', 'update']]);
        //$this->middleware(['permission:role-delete'], ['only' => ['destroy']]);
        
        $this->middleware('auth');
    }

    public function index(AbsensiDeviceUsersDataTable $dataTable)
    {
        return $dataTable->render('vendor.adminlte.absensi-device-users.index');
    }

    public function create(Request $request)
    {
        if($request->ajax()){
            return view('vendor.adminlte.absensi-device-users.form-create');
        }else{
            return view('vendor.adminlte.absensi-device-users.create');
        }
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'id_device' => 'required',
			'device_no' => '',
			'id_user' => 'required',
			'user_no' => 'required',
			'device_user_name' => 'required',
        ]);

        $user_id = Auth::user()->id;
        $dt = [
			'id_device' => $request->input('id_device'),
			'device_no' => AbsensiDeviceModel::find($request->input('id_device'))->first()->device_no,
			'id_user' => $request->input('id_user'),
			'user_no' => $request->input('user_no'),
			'device_user_name' => $request->input('device_user_name'),
        ];

        $absensi_device_user = AbsensiDeviceUserModel::create($dt);

		if($request->ajax())
		{
			return Response::json(['data' => $absensi_device_user, 'status' => 'Success', 'message' => 'Data Berhasil disimpan']);
		}else{
			return redirect()->route('admin.absensi_device_user.index')
				->with('success', 'Data berhasil disimpan');
		}
    }

    public function show($id,Request $request)
    {
        $absensi_device_user = AbsensiDeviceUserModel::find($id);

        if($request->ajax()){
            return view('vendor.adminlte.absensi-device-users.form-show', compact('absensi_device_user'));
        }else{
            return view('vendor.adminlte.absensi-device-users.show', compact('absensi_device_user'));
        }
    }

    public function edit($id,Request $request)
    {
        $absensi_device_user = AbsensiDeviceUserModel::find($id);

        if($request->ajax()){
            return view('vendor.adminlte.absensi-device-users.form-edit', compact('absensi_device_user'));
        }else{
            return view('vendor.adminlte.absensi-device-users.edit', compact('absensi_device_user'));
        }
    }

    public function update(Request $request, AbsensiDeviceUserModel $absensi_device_user)
    {
        $this->validate($request, [
            'id_device' => 'required',
			'device_no' => '',
			'id_user' => 'required',
			'user_no' => 'required',
			'device_user_name' => 'required',
        ]);

        $user_id = Auth::user()->id;
		$absensi_device_user->id_device = $request->input('id_device');
		$absensi_device_user->device_no = AbsensiDeviceModel::find($request->input('id_device'))->first()->device_no;
		$absensi_device_user->id_user = $request->input('id_user');
		$absensi_device_user->user_no = $request->input('user_no');
		$absensi_device_user->device_user_name = $request->input('device_user_name');
        
        $absensi_device_user->save();

		if($request->ajax())
		{
			return Response::json(['data' => $absensi_device_user, 'status' => 'Success', 'message' => 'Data Berhasil disimpan']);
		}else{
			return redirect()->route('admin.absensi_device_user.index')
				->with('success', 'Data berhasil diubah');
		}
    }

    public function destroy(AbsensiDeviceUserModel $absensi_device_user, Request $request)
    {
        $absensi_device_user->delete();
        return redirect()->route('admin.absensi_device_user.index')
            ->with('success', 'Data telah dihapus');
    }
    
    public function pdf($id,Request $request)
    {
        $absensi_device_user = AbsensiDeviceUserModel::find($id);

        $pdf = PDF::loadView('vendor.adminlte.absensi-device-users.pdf', compact('absensi_device_user'))->setOptions(['defaultFont' => 'sans-serif']);

        return $pdf->download(Str::kebab($absensi_device_user->nama_percumahan).'.pdf');

        if($request->ajax()){
            return view('vendor.adminlte.absensi-device-users.form-print', compact('absensi_device_user'));
        }else{
            return view('vendor.adminlte.absensi-device-users.print', compact('absensi_device_user'));
        }
    }
    public function print($id,Request $request)
    {
        $absensi_device_user = AbsensiDeviceUserModel::find($id);

        
        if($request->ajax()){
            return view('vendor.adminlte.absensi-device-users.form-print', compact('absensi_device_user'));
        }else{
            return view('vendor.adminlte.absensi-device-users.print', compact('absensi_device_user'));
        }
    }
    
}
