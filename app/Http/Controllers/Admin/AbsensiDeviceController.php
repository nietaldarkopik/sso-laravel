<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\AbsensiDeviceModel;
use App\DataTables\AbsensiDevicesDataTable;
use MatanYadaev\EloquentSpatial\Objects\Polygon;
use MatanYadaev\EloquentSpatial\Objects\LineString;
use MatanYadaev\EloquentSpatial\Objects\Point;
use MatanYadaev\EloquentSpatial\Enums\Srid;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use DB;
use Auth;
use Str;
use PDF;

class AbsensiDeviceController extends Controller
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

    public function index(AbsensiDevicesDataTable $dataTable)
    {
        return $dataTable->render('vendor.adminlte.absensi-devices.index');
    }

    public function create(Request $request)
    {
        if($request->ajax()){
            return view('vendor.adminlte.absensi-devices.form-create');
        }else{
            return view('vendor.adminlte.absensi-devices.create');
        }
    }

    public function store(Request $request)
    {
        $this->validate($request, [
			'device_no' => 'required',
			'device_name' => 'required',
			'sn' => 'required',
			'ip_public' => '',
			'ip_local' => '',
			'port_public' => '',
			'port_local' => '',
			'status' => '',
			'location' => '',
        ]);
		
        $user_id = Auth::user()->id;
        $dt = [
			'device_no' => $request->input('device_no'),
			'device_name' => $request->input('device_name'),
			'sn' => $request->input('sn'),
			'ip_public' => $request->input('ip_public'),
			'ip_local' => $request->input('ip_local'),
			'port_public' => $request->input('port_public'),
			'port_local' => $request->input('port_local'),
			'status' => $request->input('status'),
			'location' => $request->input('location'),
        ];

        $absensi_device = AbsensiDeviceModel::create($dt);

		if($request->ajax())
		{
			return Response::json(['data' => $absensi_device,'status' => 'success', 'message' => 'Data berhasil disimpan']);
		}else{
			return redirect()->route('admin.absensi_device.index')
				->with('success', 'Device berhasil disimpan');
		}
    }

    public function show($id,Request $request)
    {
        $absensi_device = AbsensiDeviceModel::find($id);

        if($request->ajax()){
            return view('vendor.adminlte.absensi-devices.form-show', compact('absensi_device'));
        }else{
            return view('vendor.adminlte.absensi-devices.show', compact('absensi_device'));
        }
    }

    public function edit($id,Request $request)
    {
        $absensi_device = AbsensiDeviceModel::find($id);

        if($request->ajax()){
            return view('vendor.adminlte.absensi-devices.form-edit', compact('absensi_device'));
        }else{
            return view('vendor.adminlte.absensi-devices.edit', compact('absensi_device'));
        }
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
			'device_no' => 'required',
			'device_name' => 'required',
			'sn' => 'required',
			'ip_public' => '',
			'ip_local' => '',
			'port_public' => '',
			'port_local' => '',
			'status' => '',
			'location' => '',
        ]);

        $user_id = Auth::user()->id;

        $absensi_device = AbsensiDeviceModel::find($id);
		$absensi_device->device_no = $request->input('device_no');
		$absensi_device->device_name = $request->input('device_name');
		$absensi_device->sn = $request->input('sn');
		$absensi_device->ip_public = $request->input('ip_public');
		$absensi_device->ip_local = $request->input('ip_local');
		$absensi_device->port_public = $request->input('port_public');
		$absensi_device->port_local = $request->input('port_local');
		$absensi_device->status = $request->input('status');
		$absensi_device->location = $request->input('location');
        
        $absensi_device->save();


		if($request->ajax())
		{
			return Response::json(['data' => $absensi_device,'status' => 'success', 'message' => 'Data berhasil disimpan']);
		}else{
			return redirect()->route('admin.absensi_device.index')
				->with('success', 'Device berhasil diubah');
		}
    }

    public function destroy(AbsensiDeviceModel $absensi_device, Request $request)
    {
        $absensi_device->delete();
        return redirect()->route('admin.absensi_device.index')
            ->with('success', 'Device telah dihapus');
    }
        
}
