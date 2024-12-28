<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Controller;
use App\Models\AbsensiAttendenceLogModel;
use App\Models\AbsensiAttendenceModel;
use App\Models\AbsensiDeviceModel;
use App\Models\AbsensiLogModel;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Http;
use DB;

class ServiceADMSController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('front.layouts.beranda');
    }

    public function showDevices()
    {
        return view('front.layouts.beranda');
    }
    public function getDevices(AbsensiAttendencesDataTable $dataTableDevices)
    {
        return $dataTableDevices->render('front.layouts.beranda.index');
        //return view('front.layouts.beranda');
    }

    public function setDevices()
    {
        return view('front.layouts.beranda');
    }

	public function device_data(){
		$data = AbsensiDeviceModel::select(DB::raw('device_no,device_name,(CONCAT(LEFT(sn, LENGTH(sn)-7), REPEAT("*", 4))) AS sn,location,status, created_at, updated_at'))->get(); // Atau gunakan query builder untuk pengambilan data
        return DataTables::of($data)->make(true);
	}

	public function presensi_data(Request $request){
		/* $data = AbsensiAttendenceModel::
		select(
			DB::raw('
					id_device,
					id_device_datang,
					id_device_pulang,
					id_user,
					user_no,
					device_no,
					DATE_FORMAT(datang, "%d/%M/%Y %H:%i:%s") as datang,
					if(pulang = datang,"-",DATE_FORMAT(pulang, "%d/%M/%Y %H:%i:%s")) as pulang, 
					CONVERT_TZ(created_at, "+00:00", "+07:00") as created_at, 
					CONVERT_TZ(updated_at, "+00:00", "+07:00") as updated_at'
					)
				); */


		//$data = AbsensiAttendenceModel::join('absensi_users', 'absensi_users.id', '=', 'absensi_attendences.id_user')
		$data = DB::table("absensi_attendences")->join('absensi_users', 'absensi_users.id', '=', 'absensi_attendences.id_user')
				->join('absensi_devices', 'absensi_devices.id', '=', 'absensi_attendences.id_device')
				->join('absensi_device_users', function($join){
					$join->on('absensi_device_users.id_user', '=', 'absensi_users.id');
				})->
		select(
			DB::raw('
					absensi_users.nama,
					absensi_users.jabatan,
					absensi_device_users.id_device,
					id_device_datang,
					id_device_pulang,
					absensi_device_users.id_user,
					absensi_device_users.user_no,
					absensi_device_users.device_no,
					absensi_devices.device_name,
					absensi_devices.location,
					DATE_FORMAT(datang, "%d/%M/%Y %H:%i:%s") as datang,
					if(pulang = datang,"-",DATE_FORMAT(pulang, "%d/%M/%Y %H:%i:%s")) as pulang, 
					CONVERT_TZ(absensi_attendences.created_at, "+00:00", "+07:00") as created_at, 
					CONVERT_TZ(absensi_attendences.updated_at, "+00:00", "+07:00") as updated_at'
					)
				);
		
		$search = $request->input('search');
		$search = (isset($search['value']) and !empty($search['value']))?$search['value']:'';


		$columns = $request->columns ?? [];
		/* $data->where(function ($query) use ($columns) {
			if (count($columns) > 0) {
				foreach ($columns as $i => $c) {
					if (!in_array($c['data'], ['DT_RowIndex']) && isset($c['search'])) {
						$query->orWhere($c['data'], 'like', '%' . $c['search']['value'] . '%');
					}
				}
			}
		}); */
		
		/* $data->with([
			'device' => function($query) use ($search){
				$query->select(DB::raw('id,device_no,device_name,(CONCAT(LEFT(sn, LENGTH(sn)-7), REPEAT("*", 4))) AS sn,location,status'));
				if(!empty($search))
				{
					$query->orWhere('device_no','like','%'.$search.'%');
					$query->orWhere('device_name','like','%'.$search.'%');
					$query->orWhere('sn','like','%'.$search.'%');
					$query->orWhere('location','like','%'.$search.'%');

				}
			},
			'user' => function($query) use ($search){
				if(!empty($search))
				{
					$query->orWhere('nama','like','%'.$search.'%');
					$query->orWhere('jabatan','like','%'.$search.'%');
					$query->orWhere('jenis_kelamin','like','%'.$search.'%');
				}
			}
		]); */


		$data->where('tanggal','like',date("Y-m-d").'%');
		
		// Handle sorting
		if ($request->has('order')) {
			$columnIndex = $request->input('order.0.column'); // Index kolom yang diurutkan
			$sortDirection = $request->input('order.0.dir'); // ASC atau DESC
			$column = $columns[$columnIndex];
			
			if(isset($column['data']))
			{
				$column = $column['data'];
				$data->orderByRaw("$column $sortDirection");
			}else{
				$data->orderBy('created_at','desc')->orderBy('updated_at','desc');
			}
		}
		//$data = $data->get(); // Atau gunakan query builder untuk pengambilan data

        return DataTables::of($data)->make(true);
	}

	public function ping_device(){
		$data = AbsensiLogModel::whereRaw('created_at > DATE_SUB("'.date("Y-m-d H:i:s").'", INTERVAL 2 MINUTE)')->get(); // Atau gunakan query builder untuk pengambilan data
		AbsensiDeviceModel::where('status','=','Aktif')->update(['status' => 'Tidak Aktif']);
		if($data->count())
		{
			foreach($data as $i => $d){
				$the_get = $d->the_get;
				if(!empty($the_get))
				{
					$the_get = json_decode($the_get);
					$sn = (isset($the_get->SN) and !empty($the_get->SN))?$the_get->SN:false;
					if($sn)
					{
						AbsensiDeviceModel::where('sn','=',$sn)->update(['status' => 'Aktif']);
					}
				}
			}
		}
	}

	public function last_present(){
		$id_attendence = session('id_attendence_log');
		$id_attendence = (is_array($id_attendence))?$id_attendence:[0];

		$q = AbsensiAttendenceLogModel::selectRaw('*, if(updated_at is null,created_at,updated_at) sorting')
									->orderBy("sorting","asc")
									->whereRaw('(created_at > DATE_SUB("'.date("Y-m-d H:i:s").'", INTERVAL 1 MINUTE))'); //->get(); // Atau gunakan query builder untuk pengambilan data
									$q->with(['user','device']);

		if(is_array($id_attendence) and count($id_attendence)){
			$q->whereNotIn('id',$id_attendence);
		}
		/* 
			$presensi = AbsensiAttendenceLogModel::
			->whereRaw('(created_at > DATE_SUB("'.date("Y-m-d H:i:s").'", INTERVAL 1 MINUTE))'); //->get(); // Atau gunakan query builder untuk pengambilan data
			$q->with(['user','device']);
		*/
		$data = $q;
		$first = $data->get()->first();
		$id = $first->id ?? 0;
		if(!empty($id))
		{
			$id_attendence[$id] = $id;
		}
		
		//dd($first,$q->toSql(),$id_attendence,session('id_attendence_log'));

		session(['id_attendence_log' => $id_attendence]);
		if(empty($first)){
			return "";
		}
		//return Response::json(['data' => $first]);
		return view('front.services.user-present',['data' => $first]);
	}


    public function fetchTTS(Request $request)
    {
        $id_attendence_log = $request->query('id_attendence_log');
        $lang = $request->query('lang', 'id');

		$currAttendenceLog = AbsensiAttendenceLogModel::find($id_attendence_log);
		$id_device = $currAttendenceLog->id_device ?? 0;
		$id_user = $currAttendenceLog->id_user ?? 0;
		$user_no = $currAttendenceLog->user_no ?? 0;
		$device_no = $currAttendenceLog->device_no ?? 0;

		$datangAttendenceLog = AbsensiAttendenceLogModel::where('id','!=',$id_attendence_log)
															->where('id_device','=', $id_device)
															->where('id_user','=', $id_user)
															->where('user_no','=', $user_no)
															->where('device_no','=', $device_no)
															->get()->first();
		$text = "";
		$salut = "";
		$nama = "";
		$jabatan = "";
		$greet = "";

		if(isset($currAttendenceLog->user->jenis_kelamin) && strtolower($currAttendenceLog->user->jenis_kelamin) == "laki-laki")
		{
			$salut = " Bapak ";
		}else if(isset($currAttendenceLog->user->jenis_kelamin) && strtolower($currAttendenceLog->user->jenis_kelamin) == "perempuan"){
			$salut = " Ibu ";
		}

		if(isset($currAttendenceLog->user->nama) and !empty($currAttendenceLog->user->nama))
		{
			$nama = $currAttendenceLog->user->nama;
		}

		if(isset($currAttendenceLog->user->jabatan) and !empty($currAttendenceLog->user->jabatan))
		{
			$jabatan = $currAttendenceLog->user->jabatan;
		}

		if(!empty($datangAttendenceLog))
		{
			$greet = "Terimakasih ";
		}else{
			$greet = "Selamat Datang ";
		}
		
		$text = "$greet $salut $nama $jabatan";

        if (!$text) {
            return response()->json(['error' => 'Text parameter is required'], 400);
        }

        $url = "https://translate.google.com/translate_tts?ie=UTF-8&q=" . urlencode($text) . "&tl=" . $lang . "&client=tw-ob";

        $response = Http::withHeaders(['User-Agent' => 'Mozilla/5.0'])->get($url);

        if ($response->successful()) {
            return response($response->body(), 200)
                ->header('Content-Type', 'audio/mpeg');
        }

        return response()->json(['error' => 'Failed to fetch audio'], $response->status());
    }
}
