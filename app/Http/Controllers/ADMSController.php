<?php

namespace App\Http\Controllers;

use App\Libraries\ADMSLibrary;
use App\Models\AbsensiLogModel;
use App\Models\RequestLog;
use Illuminate\Http\Request;
use Raysulkobir\ZktecoLaravel\Lib\ZKTeco;
use Laradevsbd\Zkteco\Http\Library\ZktecoLib;
use Carbon\Carbon;
use DB;

class ADMSController extends Controller
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
	public function index(Request $request)
	{
/* 
        // Mengambil data dari GET request
        $dget = $request->query();

        // Mengambil data dari POST request
        $dpost = $request->post();

        // Mengambil semua data dari request
        $drequest = $request->all();
        $dserver = $_SERVER ?? [];

        // Mengambil data dari php://input
        //$draw = $request->all(); //file_get_contents('php://input'); //		$request->getContent();
        $draw = $_SESSION['raw_input'] ?? $request->getContent();

        // Mengambil data dari SERVER variabel
        $duser_agent = $request->server('HTTP_USER_AGENT');

		$dt = [
			"the_post" => json_encode($dpost),
			"the_get" => json_encode($dget),
			"the_request" => json_encode($drequest),
			"the_server" => json_encode($dserver),
			"the_raw" => json_encode($draw),
			"user_agent" => json_encode($duser_agent)
		]; */

		$adms = new ADMSLibrary();
		$adms->init();

		//RequestLog::where("the_get","like",'%SN%:%');
		//whereJsonContains('the_get->SN', 'waterproof')->get();
		//$AbsensiAttendenceLog = AbsensiAttendenceLogModel::create($dt);		
		//$AbsensiAttendence = AbsensiAttendenceModel::create($dt);		
		//$AbsensiDevice = AbsensiDeviceModel::create($dt);		
		//$AbsensiDeviceUser = AbsensiDeviceUserModel::create($dt);		
		//$AbsensiLog = AbsensiLogModel::create($dt);		
		//$AbsensiUser = AbsensiUserModel::create($dt);

		/* dd($adms); */

		return "OK";
	}

	function profile(){
		
		$q = \App\Models\AbsensiAttendenceLogModel::selectRaw('*, if(updated_at is null,created_at,updated_at) sorting')
									->orderBy("sorting","asc")
									->whereRaw('(created_at > DATE_SUB(NOW(), INTERVAL 10 MINUTE))'); //->get(); // Atau gunakan query builder untuk pengambilan data
									$q->with(['user','device']);

		$data = $q;
		$first = $data->get()->first();
		$id = $first->id ?? 0;

		if(empty($first)){
			return "";
		}

		//return Response::json(['data' => $first]);
		return view('front.services.user-present',['data' => $first]);
	}

	function getrequest(Request $request){

		
		return "Ok"; 
		
        $adjustedTime = Carbon::now('Asia/Jakarta')->subHour()->toRfc7231String();
		/* response("Ok");//->header('Date', $adjustedTime);
		$maxcmd = DB::table('absensi_commands')->max('id');
		$maxcmd = $maxcmd + 1;
		$cmd =  "C:".$maxcmd.":INFO";
		//$cmd =  "C:".$maxcmd.":CHECK";
		//$cmd =  "C:".$maxcmd.":SET OPTION Timezone=7";
		DB::table('absensi_commands')->insert(['server_output' => $cmd,'requests' => $request]); 
		*/

		return $cmd;
		$sn = $request->get('SN');
		$options = [];
		$options[] = trim('GET OPTION FROM: '.$sn);
		//$options[] = 'ATTLOGStamp=None';
		//$options[] = 'OPERLOGStamp=9999';
		//$options[] = 'ATTPHOTOStamp=None';
		//$options[] = 'ErrorDelay=30';
		//$options[] = 'Delay=10';
		//$options[] = 'TransTimes=00:00;14: 05;
		//$options[] = 'Transinterval=1';
		//$options[] = 'TransFlag=TransData AttLog OpLog AttPhoto EnrollUser ChgUser EnrollFP ChgFP UserPic';
		$options[] = 'TimeZone=7';
		$options[] = 'Realtime=1';
		$options[] = 'Encrypt=None';

		$output = implode("\n",$options);
		DB::table("absensi_log_outputs")->insert(['requests' => '', 'server_output' => $output]);
		
		return response($output)->header('Date', $dateInGMT);
		//return date("Y-m-d H:i:s");
	}
}
