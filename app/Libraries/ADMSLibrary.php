<?php
//FP PIN=6	FID=4	Size=1452	Valid=1	TMP=TX9TUzIxAAAEPEEECAUHCc7QAADwPHwBAAAAhOEfdTwPAIAPZwDmAHsziQAlAAwPswBBPAoPqgBMAEoNHjxRAOAOfACRAIYzIgBWAOkOawBdPB4NVQBoAKkPujxpAJwOSwC/APIzLwB8AOgPYwCMPCoPJACVAJ8PUzymAF8PKwBrAOQzXwC+AEkNsAC6PDkOVwC/AJ0OLTzUAE8PoQAeAD0zkgDnAD4PtQDsPEUPXwDqAI8PjDwnAUYPZQDtAUszIQA4AUMPSQBVPccPjABhAY0PXDxoAcUNVQLndDtK1AIGdDJ104z+sMsBpYhOAeONIUwb9W8MuPsW+LdLsHhuG/v09QvKPqZ9FZCBhm70bUUD74KHhX5LDUZOYI0JE8OYLJORy08CMpIfDN6fWUP0dw9kYQqQGjoWVIvmkpqDdfI9LuzuyfLK4CPaIC7o+iog9nLm+Sc3rP2/9eMB4AXGweoJufw+CccPNTTz9/YDuvm/g38/MwlXiu8H8vdbvwL3/YB6g5p6/biyhfcHt31uAoNHqGYYFCBAxAKiH9sDAG0QfToOBHca9/5b/cCKRgE8shkTwD8NxVEbwf/CQEb/Nc0AkRUNPf9ACQBVNI1AesMFAJI1yf5hLAE6MPrBSzv/QH3B/wgAi0BMh4AtATNC8P5UOv/7wVT/QAMAeoED+TsBckWDwsBOBgRGSQ9X/ggAWU0U/ChMCgB4VEOAx1vBBADKVh77CQReWICSdMEOxWpdPDEzwf3AN8EAVVtxwv8QAFmi+jfC/kD+PlsIxVJoUcDAb8AFAAdsI/00FQAPc+A6QDHC/1dAPv8SxU5+zP79Jy5XVo4RBGV99/78LjAETFI0AVd9d53BtQsEnoWekMPDiwcKBJaIJP4+W8DPAKOwKv//U1gExSCSYnkFACSZWgXBxCsBDpXewEzvRjXCwTtUEABqYRf5wTpK/1NbC8VUrFx5wsBkwBLFaKwewf39wD7AOsDEcSwVAC2q4Pj8+sH//f7+wP8FwMT8/k0MAGOqtMVoXlQRAGWxID7/+v02/lfBw/wGDwRuvl6JwEr/BZH5MAFdwD3/wDlcR/8PAGjANP7qSvvDwMHDDQBjBDo8eEJ4DwB2wfH+UPz+/1PDLg/FVsdmglTAemgWxSvV6sH+//78/j79+cLB/v/A/8EEwPvCBAAl2FN0wwAv5VHAagcAoiU3Tn0EAHDsRsGHCARj7En/wMBRzQCXzjxVTxoACxjQ+v3+wf7//v87/fobKlVY/x0Az/PLeME2Kvz9/jj++8P+wf/B//8F/nInAQ/+yTVXOi7/GP9KSkzAB9ViL2zB/8TE/QTVZy91QQUQiC1GkQQULj1DWQUQH/pDxAAFEKpNQFzBEJFpTW0EELJNhVwALIpVUGgYEOhqucPA/jJqwP8i+lD8a8T/UkIA10MFPQAAYADMSsUAFnlTAAAAAAA=
//OPLOG 0	0	2024-07-07 01:42:53	0	0	0	0
//OPLOG 3	0	2024-07-07 01:43:07	54	0	0	0
//OPLOG 4	0	2024-07-07 01:44:19	1	0	0	0
//7	2024-07-07 01:29:01	0	1	0	0	0	0	0	0	
//~DeviceName=X903,MAC=00:17:61:12:ba:c5,TransactionCount=71,~MaxAttLogCount=5,UserCount=8,~MaxUserCount=5,PhotoFunOn=0,~MaxUserPhotoCount=0,FingerFunOn=1,FPVersion=10,~MaxFingerCount=5,FPCount=19,FaceFunOn=1,FaceVersion=35,~MaxFaceCount=500,FaceCount=4,FvFunOn=0,FvVersion=3,~MaxFvCount=10,FvCount=0,PvFunOn=0,PvVersion=12,~MaxPvCount=,PvCount=0,Language=73,IPAddress=192.168.131.150,~Platform=ZMM510_TFT,~OEMVendor=Solution,FWVersion=ZMM510-NF-Ver1.0.19,PushVersion=Ver 2.0.33S-20211012,RegDeviceType=,VisilightFun=1,MultiBioDataSupport=0:1:0:0:0:0:0:0:0:1,MultiBioPhotoSupport=0:0:0:0:0:0:0:0:0:1,IRTempDetectionFunOn=,MaskDetectionFunOn=,UserPicURLFunOn=1,VisualIntercomFunOn=,VideoTID=,QRCodeDecryptFunList=,VideoProtocol=,IsSupportQRcode=,QRCodeEnable=,SubcontractingUpgradeFunOn=1
//USER PIN=6	Name=Wmjt	Pri=0	Passwd=12345	Card=	Grp=1	TZ=0000000100000000	Verify=0	ViceCard=	StartDatetime=0	EndDatetime=0


namespace App\Libraries;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AbsensiLogModel;
use App\Models\AbsensiAttendenceLogModel;
use App\Models\AbsensiAttendenceModel;
use App\Models\AbsensiDeviceModel;
use App\Models\AbsensiDeviceUserModel;
use App\Models\AbsensiUserModel;
use Yajra\DataTables\DataTables;
use DB;

class ADMSLibrary extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

	var $absensi_log = 0;

    public function init()
    {
		$request = request();
		
        //$this->middleware('auth');
        $dget = $request->query();
        $dpost = $request->post();
        $drequest = $request->all();
        $dserver = $_SERVER ?? [];
        //$draw = $request->all(); //file_get_contents('php://input'); //		$request->getContent();
        $draw = file_get_contents('php://input');
        //$draw = (empty($draw))?$_SESSION['raw_input'] ?? $request->getContent() : $draw;
        $draw = (empty($draw) && isset($_SESSION['raw_input']))? $_SESSION['raw_input']: $draw;
		$draw = (empty($draw))?$request->getContent() : $draw;
        $duser_agent = $request->server('HTTP_USER_AGENT');

		$dt = [
			"the_post" => json_encode($dpost),
			"the_get" => json_encode($dget),
			"the_request" => json_encode($drequest),
			"the_server" => json_encode($dserver),
			"the_raw" => (is_object($draw) or is_array($draw))?json_encode($draw):$draw,
			"user_agent" => json_encode($duser_agent),
			'created_at' => date("Y-m-d H:i:s"),
			'updated_at' => date("Y-m-d H:i:s"),
		];

		$this->absensi_log = $this->SetAbsensiLog($dt,$dt['the_raw']);
    }
	
	function SetAbsensiLog($dt,$raw = null){
		$AbsensiLog = AbsensiLogModel::create($dt);
		$the_get = json_decode($AbsensiLog->the_get);
		$the_raw2 = explode("\n", trim($AbsensiLog->the_raw)) ?? [];
		$the_raw = explode("\t", trim($AbsensiLog->the_raw));
		$the_get_table = $the_get->table ?? "";

		$sn = (isset($the_get->SN))?$the_get->SN:"";
		//$is_new_user = (isset($the_raw[0]) && $the_raw[0] == 'USER PIN')?true:false; //USER PIN=6	Name=Wmjt	Pri=0	Passwd=12345	Card=	Grp=1	TZ=0000000100000000	Verify=0	ViceCard=	StartDatetime=0	EndDatetime=0
		$device = (!empty($sn))?AbsensiDeviceModel::where('sn','=',$sn)->get()->first():false;
		
		$the_raw_array = [];
		if(is_array($the_raw) and count($the_raw) > 0)
		{
			foreach($the_raw as $i => $r)
			{
				$kv = explode("=",$r);

				if(count($kv) > 1)
				{
					$the_raw_array[trim($kv[0])] = $kv[1];
				}
				else
				{
					$the_raw_array[$i] = $r;
				}
			}
		}

		//OPERLOG || ATTLOG

		if($the_get_table == "ATTLOG" && !empty($device) && isset($device->id) && !empty($the_raw[0])) ////7	2024-07-07 01:29:01	0	1	0	0	0	0	0	0	
		{
			$user = AbsensiDeviceUserModel::where('user_no','=',$the_raw[0])->where('id_device','=',$device->id)->get()->first();
			$id_device = $device->id;
			$id_user = $user->id_user ?? 0;
			$user_no = $the_raw[0];
			$device_no = $device->device_no;
			$waktu = $the_raw[1];

			$params = [
				'id_device' => $id_device,
				'id_user' => $id_user,
				'user_no' => $user_no,
				'device_no' => $device_no,
				'waktu' => date("Y-m-d H:i:s"), //$waktu,
				'created_at' => date("Y-m-d H:i:s"),
				'updated_at' => date("Y-m-d H:i:s"),
			];

			$this->SetAbsensiAttendenceLog($params,$AbsensiLog->the_raw);
		}

		if($the_get_table == "options") 
		{

			$the_raw_options = explode(",",trim($AbsensiLog->the_raw));
			$the_raw_options_array = [];
			if(is_array($the_raw_options) and count($the_raw_options) > 0)
			{
				foreach($the_raw_options as $i => $r)
				{
					$kv = explode("=",$r);
					
					if(count($kv) > 1)
					{
						$the_raw_options_array[trim(str_replace('~','',$kv[0]))] = $kv[1];
					}
					else
					{
						$the_raw_options_array[$i] = $r;
					}
				}
			}
			
			if(isset($the_raw_options_array['DeviceName']) and !empty($the_raw_options_array['DeviceName']))
			{
				$dt_device = [
					'raw' => trim($AbsensiLog->the_raw),
					'device_no' =>  $the_raw_options_array['MAC'] ?? '',
					'device_name' => $the_raw_options_array['DeviceName'] ?? 'NoName',
					'sn' => $sn,
					'ip_public' => $the_raw_options_array['IPAddress'] ?? '',
					'ip_local' => $the_raw_options_array['IPAddress'] ?? '',
					'port_public' => '0',
					'port_local' => '0',
					'location' => '--Diperlukan Penyesuaian--',
					'status' => 'Aktif',
				];

				$device = AbsensiDeviceModel::where('sn','=',$sn)->where('device_no','=',$the_raw_options_array['MAC'])->get()->first();
				if(!empty($device))
				{
					$device->status = 'Aktif';
					$device->save();
				}else{
					$device = AbsensiDeviceModel::create($dt_device);
				}

			}
		}


		// OPLOG 70	0	2024-07-11 10:26:27	10	0	0	0
		// USER PIN=10	Name=Ifa	Pri=0	Passwd=	Card=	Grp=1	TZ=0000000100000000	Verify=0	ViceCard=	StartDatetime=0	EndDatetime=0
		if($the_get_table == "OPERLOG" && !empty($device) && isset($device->id) && !empty($the_raw[0])) 
		{
			$is_save_user = (isset($the_raw_array['USER PIN']))?TRUE:FALSE;

			/*** START kETERANGAN */
			/**
			 * $the_raw[0] => 'OPLOG'
			 * $the_raw[1] => Kode OP 
			 * 					4 => Ketika Device Membuka user tertentu
			 * 					6 => Ketika device ingin membuat atau edit fingerprint user
			 * 
			 */

			
			/*** END kETERANGAN */
			if($is_save_user)
			{
				$params = [
					'id_device' => $device->id,
					'device_no' => $device->device_no,
					'id_user' => '0',
					'user_no' => $the_raw_array['USER PIN'],
					'device_user_name' => $the_raw_array['Name'],
					'passwd' => $the_raw_array['Passwd'],
					'created_at' => date("Y-m-d H:i:s"),
					'updated_at' => date("Y-m-d H:i:s"),
				];

				$this->SetAbsensiDeviceUser($params,$AbsensiLog->the_raw);
			}
		}
		return $AbsensiLog;
	}

	function SetAbsensiAttendenceLog($dt,$raw = null){
		$AbsensiAttendenceLog = AbsensiAttendenceLogModel::create($dt);
		$id_user = $AbsensiAttendenceLog->id_user ?? 0;
		$id_device = $AbsensiAttendenceLog->id_device ?? 0;
		$user_no = $AbsensiAttendenceLog->user_no ?? 0;
		$device_no = $AbsensiAttendenceLog->device_no ?? 0;
		$waktu = $AbsensiAttendenceLog->waktu ?? date("Y-m-d");
		$tanggal = \Carbon\Carbon::parse($waktu)->translatedFormat("Y-m-d");
		$AbsensiAttendence  = AbsensiAttendenceModel::where('id_device','=',$id_device)->where('id_user','=',$id_user)->where(function($query) use ($tanggal){
			$query->where('tanggal','=',$tanggal);
		})->first();

		$minMaxTanggal  = AbsensiAttendenceLogModel::selectRaw('MIN(waktu) as min_waktu, MAX(waktu) as max_waktu')
													//->where('id_device','=',$id_device)
													->where('id_user','=',$id_user)
													->where(function($query) use ($tanggal){
														$query->where('waktu','like',$tanggal.'%');
													})
													->first();
		
		$params = [
			'id_device' => $id_device,
			'id_device_datang' => $id_device,
			'id_device_pulang' => $id_device,
			'id_user' => $id_user,
			'user_no' => $user_no,
			'device_no' => $device_no,
			'datang' => $minMaxTanggal->min_waktu ?? $waktu,
			'pulang' => $waktu,
			'tanggal' => $tanggal,
			'raw' => $raw,
			'created_at' => date("Y-m-d H:i:s"),
			'updated_at' => date("Y-m-d H:i:s"),
		];

		if(empty($AbsensiAttendence))
		{
			AbsensiAttendenceModel::create($params);
		}else{
			$AbsensiAttendence->datang = $params['datang'];
			$AbsensiAttendence->pulang = $params['pulang'];
			$AbsensiAttendence->id_device_pulang = $id_device;
			$AbsensiAttendence->raw = $raw;
			//$AbsensiAttendence->created_at = date("Y-m-d H:i:s");
			$AbsensiAttendence->updated_at = date("Y-m-d H:i:s");
			$AbsensiAttendence->save();
		}

	}

	function SetAbsensiAttendence(){
		$AbsensiAttendence = AbsensiAttendenceModel::create($dt);
	}

	function SetAbsensiDevice(){
		$AbsensiDevice = AbsensiDeviceModel::create($dt);
	}

	function SetAbsensiDeviceUser($dt,$raw = null)
	{
		$checkDeviceUser = AbsensiDeviceUserModel::where('id_device','=',$dt['id_device'])
													->where('user_no','=',$dt['user_no'])
													->get()->first();
		if(empty($checkDeviceUser))
		{
			$dtUser = [
				'nama' => $dt['device_user_name'],
				'raw' => $raw,
				'jabatan' => '-- Diperlukan Penyesuaian --',
				//'jenis_kelamin' => '',
				//'id_unit' => '',
				//'photo' => '',
			];

			$newUser = AbsensiUserModel::create($dtUser);
			$id_user = $newUser->id ?? 0;

			$params = [
				'raw' => $raw,
				'id_device' => $dt['id_device'],
				'device_no' => $dt['device_no'],
				'id_user' => $id_user,
				'user_no' => $dt['user_no'],
				'device_user_name' => $dt['device_user_name'],
				'passwd' => $dt['passwd'],
				'created_at' => $dt['created_at'],
				'updated_at' => $dt['updated_at'],
			];
			$AbsensiDeviceUser = AbsensiDeviceUserModel::create($params,$raw);
		}else{
			$checkDeviceUser->raw = $raw;
			$checkDeviceUser->id_device = $dt['id_device'];
			$checkDeviceUser->device_no = $dt['device_no'];
			//$checkDeviceUser->id_user = $id_user;
			$checkDeviceUser->user_no = $dt['user_no'];
			$checkDeviceUser->device_user_name = $dt['device_user_name'];
			$checkDeviceUser->passwd = $dt['passwd'];
			//$checkDeviceUser->created_at = $dt['created_at'];
			$checkDeviceUser->updated_at = $dt['updated_at'];
			$checkDeviceUser->save();
		}
	}

	function SetAbsensiUser(){
		return $AbsensiUser = AbsensiUserModel::create($dt);
	}
}
