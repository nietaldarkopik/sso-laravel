<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\PengajuanModel;
use App\DataTables\AbsensiLogSystemsDataTable;
use App\Models\PengajuanDokumenModel;
use MatanYadaev\EloquentSpatial\Objects\Polygon;
use MatanYadaev\EloquentSpatial\Objects\LineString;
use MatanYadaev\EloquentSpatial\Objects\Point;
use MatanYadaev\EloquentSpatial\Enums\Srid;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use DB;
use Auth;
use Str;
use PDF;

class AbsensiLogController extends Controller
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

    public function index(AbsensiLogSystemsDataTable $dataTable)
    {
        return $dataTable->render('vendor.adminlte.absensi-log-systems.index');
    }

    public function create(Request $request)
    {
        if($request->ajax()){
            return view('vendor.adminlte.absensi-log-systems.form-create');
        }else{
            return view('vendor.adminlte.absensi-log-systems.create');
        }
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            //'provinsi_id' => 'required',
            'kabkota_id' => 'required',
            'kecamatan_id' => 'required',
            'kelurahan_id' => 'required',
            //'pengembang_id' => 'required',
            'nama_pengajuan' => 'required',
            'luas' => '',
            'tahun_siteplan' => '',
            'latitude' => '',
            'longitude' => '',
            //'latlong' => '',
            'total_unit' => '',
            'jumlah_mbr' => '',
            'jumlah_nonmbr' => '',
            'no_bast' => '',
            'file_bast' => 'file|mimes:jpg,jpeg,png,pdf',
            'photo' => 'file|mimes:jpg,jpeg,png',
            'siteplan' => 'file|mimes:jpg,jpeg,png',
            'alamat' => 'required',
            'status_data' => 'required',
            'nama_pengembang' => 'required',
            'telepon_pengembang' => '',
            'email_pengembang' => '',
            'jumlah_proses' => '',
            'jumlah_ditempati' => '',
            'jumlah_kosong' => '',
            //'user_id_create' => 'required',
            //'user_id_update' => 'required',
            //'created_at' => 'required',
            //'updated_at' => 'required',
        ]);

        $file_bast = '';
        $photo = '';
        $siteplan = '';
        
        if ($request->file('file_bast')) {
            $file = $request->file('file_bast');
            $path = $file->store('uploads/pengajuan/file_bast', 'public');
            //$file_bast = $file->getClientOriginalName();
            //$file_bast = basename($path);
            $file_bast = $path;
        }
        
        if ($request->file('photo')) {
            $file = $request->file('photo');
            $path = $file->store('uploads/pengajuan/photo', 'public');
            //$photo = $file->getClientOriginalName();
            //$photo = basename($path);
            $photo = $path;
        }
        
        if ($request->file('siteplan')) {
            $file = $request->file('siteplan');
            $path = $file->store('uploads/pengajuan/siteplan', 'public');
            //$siteplan = $file->getClientOriginalName();
            //$siteplan = basename($path);
            $siteplan = $path;
        }
        

        //$fileModel = new File;
        //$fileModel->name = $file->getClientOriginalName();
        //$fileModel->path = $path;
        //$fileModel->save();

        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');
        $latlong = (empty($latitude.$longitude))?null:new Point($latitude,$longitude, Srid::WGS84->value);

        $user_id = Auth::user()->id;
        $dt = [
            'provinsi_id' => 63,
            'kabkota_id' => $request->input('kabkota_id'),
            'kecamatan_id' => $request->input('kecamatan_id'),
            'kelurahan_id' => $request->input('kelurahan_id'),
            //'pengembang_id' => $request->input('pengembang_id'),
            'nama_pengajuan' => $request->input('nama_pengajuan'),
            'luas' => $request->input('luas'),
            'tahun_siteplan' => $request->input('tahun_siteplan'),
            'latitude' => $request->input('latitude'),
            'longitude' => $request->input('longitude'),
            'latlong' => $latlong,
            'total_unit' => $request->input('total_unit'),
            'jumlah_mbr' => $request->input('jumlah_mbr'),
            'jumlah_nonmbr' => $request->input('jumlah_nonmbr'),
            'no_bast' => $request->input('no_bast'),
            //'file_bast' => $request->input('file_bast'),
            //'photo' => $request->input('photo'),
            //'siteplan' => $request->input('siteplan'),
            'alamat' => $request->input('alamat'),
            'status_data' => $request->input('status_data'),
            'nama_pengembang' => $request->input('nama_pengembang'),
            'telepon_pengembang' => $request->input('telepon_pengembang'),
            'email_pengembang' => $request->input('email_pengembang'),
            'jumlah_proses' => $request->input('jumlah_proses'),
            'jumlah_ditempati' => $request->input('jumlah_ditempati'),
            'jumlah_kosong' => $request->input('jumlah_kosong'),
            'user_id_create' => $user_id,
            'user_id_update' => $user_id,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ];

        if(!empty($file_bast))
        {
            $dt['file_bast'] = $file_bast;
        }
        if(!empty($photo))
        {
            $dt['photo'] = $photo;
        }
        if(!empty($siteplan))
        {
            $dt['siteplan'] = $siteplan;
        }

        $pengajuan = PengajuanModel::create($dt);

        return redirect()->route('admin.pengajuan.index')
            ->with('success', 'Pengajuan berhasil disimpan');
    }

    public function show($id,Request $request)
    {
        $pengajuan = PengajuanModel::find($id);

        if($request->ajax()){
            return view('vendor.adminlte.absensi-log-systems.form-show', compact('pengajuan'));
        }else{
            return view('vendor.adminlte.absensi-log-systems.show', compact('pengajuan'));
        }
    }

    public function edit($id,Request $request)
    {
        $pengajuan = PengajuanModel::find($id);

        if($request->ajax()){
            return view('vendor.adminlte.absensi-log-systems.form-edit', compact('pengajuan'));
        }else{
            return view('vendor.adminlte.absensi-log-systems.edit', compact('pengajuan'));
        }
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            #'provinsi_id' => 'required',
            'kabkota_id' => 'required',
            'kecamatan_id' => 'required',
            'kelurahan_id' => 'required',
            //'pengembang_id' => '',
            'nama_pengajuan' => 'required',
            'luas' => '',
            'tahun_siteplan' => '',
            'latitude' => '',
            'longitude' => '',
            //'latlong' => 'required',
            'total_unit' => '',
            'jumlah_mbr' => '',
            'jumlah_nonmbr' => '',
            'no_bast' => '',
            'file_bast' => 'file|mimes:jpg,jpeg,png,pdf',
            'photo' => 'file|mimes:jpg,jpeg,png',
            'siteplan' => 'file|mimes:jpg,jpeg,png',
            'alamat' => 'required',
            'status_data' => 'required',
            'nama_pengembang' => 'required',
            'telepon_pengembang' => '',
            'email_pengembang' => '',
            'jumlah_proses' => '',
            'jumlah_ditempati' => '',
            'jumlah_kosong' => '',
            //'user_id_create' => 'required',
            //'user_id_update' => 'required',
            //'created_at' => 'required',
            //'updated_at' => 'required',
        ]);

        $user_id = Auth::user()->id;

        $file_bast = '';
        $photo = '';
        $siteplan = '';
        
        if ($request->file('file_bast')) {
            $file = $request->file('file_bast');
            $path = $file->store('uploads/pengajuan/file_bast', 'public');
            //$file_bast = $file->getClientOriginalName();
            //$file_bast = basename($path);
            $file_bast = $path;
        }
        
        if ($request->file('photo')) {
            $file = $request->file('photo');
            $path = $file->store('uploads/pengajuan/photo', 'public');
            //$photo = $file->getClientOriginalName();
            //$photo = basename($path);
            $photo = $path;
        }
        
        if ($request->file('siteplan')) {
            $file = $request->file('siteplan');
            $path = $file->store('uploads/pengajuan/siteplan', 'public');
            //$siteplan = $file->getClientOriginalName();
            //$siteplan = basename($path);
            $siteplan = $path;
        }
        
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');
        $latlong = (empty($latitude.$longitude))?null:new Point($latitude,$longitude, Srid::WGS84->value);
        $pengajuan = PengajuanModel::find($id);
        $pengajuan->provinsi_id = 63;
        $pengajuan->kabkota_id = $request->input('kabkota_id');
        $pengajuan->kecamatan_id = $request->input('kecamatan_id');
        $pengajuan->kelurahan_id = $request->input('kelurahan_id');
        //$pengajuan->pengembang_id = $request->input('pengembang_id');
        $pengajuan->nama_pengajuan = $request->input('nama_pengajuan');
        $pengajuan->luas = $request->input('luas');
        $pengajuan->tahun_siteplan = $request->input('tahun_siteplan');
        $pengajuan->latitude = $request->input('latitude');
        $pengajuan->longitude = $request->input('longitude');
        $pengajuan->latlong = $latlong;
        $pengajuan->total_unit = $request->input('total_unit');
        $pengajuan->jumlah_mbr = $request->input('jumlah_mbr');
        $pengajuan->jumlah_nonmbr = $request->input('jumlah_nonmbr');
        $pengajuan->no_bast = $request->input('no_bast');
        //$pengajuan->file_bast = $request->input('file_bast');
        //$pengajuan->photo = $request->input('photo');
        //$pengajuan->siteplan = $request->input('siteplan');
        $pengajuan->alamat = $request->input('alamat');
        $pengajuan->nama_pengembang = $request->input('nama_pengembang');
        $pengajuan->telepon_pengembang = $request->input('telepon_pengembang');
        $pengajuan->email_pengembang = $request->input('email_pengembang');
        $pengajuan->jumlah_proses = $request->input('jumlah_proses');
        $pengajuan->jumlah_ditempati = $request->input('jumlah_ditempati');
        $pengajuan->jumlah_kosong = $request->input('jumlah_kosong');
        //$pengajuan->user_id_create = $request->input('user_id_create');
        $pengajuan->user_id_update = $user_id;
        //$pengajuan->created_at = $request->input('created_at');
        $pengajuan->updated_at = date("Y-m-d H:i:s");
        
        if(!empty($file_bast))
        {
            $pengajuan->file_bast = $file_bast;
        }
        if(!empty($photo))
        {
            $pengajuan->photo = $photo;
        }
        if(!empty($siteplan))
        {
            $pengajuan->siteplan = $siteplan;
        }


        $pengajuan->save();


        return redirect()->route('admin.pengajuan.index')
            ->with('success', 'Pengajuan berhasil diubah');
    }

    public function destroy(PengajuanModel $pengajuan, Request $request)
    {
        $pengajuan->delete();
        return redirect()->route('admin.pengajuan.index')
            ->with('success', 'Pengajuan telah dihapus');
    }
    
    public function pdf($id,Request $request)
    {
        $pengajuan = PengajuanModel::find($id);

        $pdf = PDF::loadView('vendor.adminlte.absensi-log-systems.pdf', compact('pengajuan'))->setOptions(['defaultFont' => 'sans-serif']);

        return $pdf->download(Str::kebab($pengajuan->nama_percumahan).'.pdf');

        if($request->ajax()){
            return view('vendor.adminlte.absensi-log-systems.form-print', compact('pengajuan'));
        }else{
            return view('vendor.adminlte.absensi-log-systems.print', compact('pengajuan'));
        }
    }
    public function print($id,Request $request)
    {
        $pengajuan = PengajuanModel::find($id);

        
        if($request->ajax()){
            return view('vendor.adminlte.absensi-log-systems.form-print', compact('pengajuan'));
        }else{
            return view('vendor.adminlte.absensi-log-systems.print', compact('pengajuan'));
        }
    }
    
}
