<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\AbsensiUserModel;
use App\Models\AbsensiDeviceUserModel;
use App\DataTables\AbsensiUsersDataTable;
use App\Models\AbsensiUserDokumenModel;
use MatanYadaev\EloquentSpatial\Objects\Polygon;
use MatanYadaev\EloquentSpatial\Objects\LineString;
use MatanYadaev\EloquentSpatial\Objects\Point;
use MatanYadaev\EloquentSpatial\Enums\Srid;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use DB;
use Auth;
use Illuminate\Support\Facades\Response;
use Str;
use PDF;
use Carbon\Carbon;

class AbsensiUserController extends Controller
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

    public function index(AbsensiUsersDataTable $dataTable)
    {
        return $dataTable->render('vendor.adminlte.absensi-users.index');
    }

    public function create(Request $request)
    {

		$units = \App\Models\UnitModel::get();
        if($request->ajax()){
            return view('vendor.adminlte.absensi-users.form-create', compact('units'));
        }else{
            return view('vendor.adminlte.absensi-users.form-create', compact('units'));
        }
    }

    public function fromDevice(Request $request)
    {

		$units = \App\Models\UnitModel::get();
        if($request->ajax()){
            return view('vendor.adminlte.absensi-users.form-create-from-device', compact('units'));
        }else{
            return view('vendor.adminlte.absensi-users.create-from-device', compact('units'));
		}
    }

    public function checkFromDevice(Request $request,$id_device = 0)
    {
		$userDevice = AbsensiDeviceUserModel::whereHas('user',function($query){
			$query->whereNull('id_unit');
			//$query->where('jabatan','=','-- Diperlukan Penyesuaian --');
		})
		->with('user')
		->where('id_device','=',$id_device)
		//->where('created_at', '>=', Carbon::now()->subHours(2))
		->get()->first();
		
		if(!empty($userDevice))
		{
			return Response::json(['data' => $userDevice, 'status' => 'success']);
		}else{
			return Response::json(['data' => [], 'status' => 'error']);
		}
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            "nama" => "required",
			"jabatan" => "",
			"jenis_kelamin" => "required",
			"id_unit" => "required",
			"photo" => "",
        ]);

        $photo = '';
        
        if ($request->file('photo')) {
            $file = $request->file('photo');
            $path = $file->store('uploads/absensi_user/photo', 'public');
            //$photo = $file->getClientOriginalName();
            //$photo = basename($path);
            $photo = $path;
        }

        $user_id = Auth::user()->id;
        $dt = [
			'nama' => $request->input('nama'),
			'jabatan' => $request->input('jabatan'),
			'jenis_kelamin' => $request->input('jenis_kelamin'),
			'id_unit' => $request->input('id_unit'),
			'photo' => $request->input('photo'),
        ];

        if(!empty($photo))
        {
            $dt['photo'] = $photo;
        }

        $absensi_user = AbsensiUserModel::create($dt);

		if($request->ajax())
		{
			return Response::json(['data' => $absensi_user, 'status' => 'success', 'message' => 'Data berhasil disimpan'],200);
		}else{
			return redirect()->route('admin.absensi_user.index')
				->with('success', 'AbsensiUser berhasil disimpan');
		}
    }

    public function show($id,Request $request)
    {
        $absensi_user = AbsensiUserModel::find($id);

        if($request->ajax()){
            return view('vendor.adminlte.absensi-users.form-show', compact('absensi_user'));
        }else{
            return view('vendor.adminlte.absensi-users.show', compact('absensi_user'));
        }
    }

    public function edit($id,Request $request)
    {
        $absensi_user = AbsensiUserModel::find($id);

        if($request->ajax()){
            return view('vendor.adminlte.absensi-users.form-edit', compact('absensi_user'));
        }else{
            return view('vendor.adminlte.absensi-users.edit', compact('absensi_user'));
        }
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
			'nama' => 'required',
			'jabatan' => 'required',
			'jenis_kelamin' => 'required',
			'id_unit' => 'required',
			'photo' => '' //file|mimes:jpg,jpeg,png',
        ]);

        $user_id = Auth::user()->id;

        $photo = '';
		
        if ($request->file('photo')) {
            $file = $request->file('photo');
            $path = $file->store('uploads/absensi_user/photo', 'public');
            //$photo = $file->getClientOriginalName();
            //$photo = basename($path);
            $photo = $path;
        }
        
        $absensi_user = AbsensiUserModel::find($id);
		$absensi_user->nama = $request->input('nama');
		$absensi_user->jabatan = $request->input('jabatan');
		$absensi_user->jenis_kelamin = $request->input('jenis_kelamin');
		$absensi_user->id_unit = $request->input('id_unit');
		//$absensi_user->photo = $request->input('photo');
        
        if(!empty($photo))
        {
            $absensi_user->photo = $photo;
        }

		$absensi_user->save();

		if($request->ajax())
		{
			return Response::json(['data' => $absensi_user,'status' => 'success', 'message' => 'Data berhasil disimpan'],200);
		}else{
			return redirect()->route('admin.absensi_user.index')
				->with('success', 'AbsensiUser berhasil diubah');
		}
    }

    public function destroy(AbsensiUserModel $absensi_user, Request $request)
    {
        $absensi_user->delete();
        return redirect()->route('admin.absensi_user.index')
            ->with('success', 'AbsensiUser telah dihapus');
    }
    
    public function pdf($id,Request $request)
    {
        $absensi_user = AbsensiUserModel::find($id);

        $pdf = PDF::loadView('vendor.adminlte.absensi-users.pdf', compact('absensi_user'))->setOptions(['defaultFont' => 'sans-serif']);

        return $pdf->download(Str::kebab($absensi_user->nama_percumahan).'.pdf');

        if($request->ajax()){
            return view('vendor.adminlte.absensi-users.form-print', compact('absensi_user'));
        }else{
            return view('vendor.adminlte.absensi-users.print', compact('absensi_user'));
        }
    }
    public function print($id,Request $request)
    {
        $absensi_user = AbsensiUserModel::find($id);

        
        if($request->ajax()){
            return view('vendor.adminlte.absensi-users.form-print', compact('absensi_user'));
        }else{
            return view('vendor.adminlte.absensi-users.print', compact('absensi_user'));
        }
    }
    
}
