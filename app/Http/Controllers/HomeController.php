<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Raysulkobir\ZktecoLaravel\Lib\ZKTeco;
use Laradevsbd\Zkteco\Http\Library\ZktecoLib;
use App\DataTables\FrontAbsensiDevicesDataTable;

class HomeController extends Controller
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

	public function test(){
		

		/* 		<GetAttLog>
		<ArgComKey xsi:type="xsd:integer">0</ArgComKey>
		<Arg>
		<PIN xsi:type="xsd:integer">All</PIN>
		</Arg>
		</GetAttLog>
				 */

		// URL layanan web
		/* $url = '192.168.131.150';

		// Isi XML yang akan dikirimkan
		$xml = '<GetAttLog>
			<ArgComKey xsi:type="xsd:integer">12345</ArgComKey>
		</GetAttLog>';

		// Pengaturan untuk permintaan cURL
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_PORT, 4370); // Set port 4370
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
		curl_setopt($ch, CURLOPT_HTTPHEADER, [
			'Content-Type: text/xml',
			'Content-Length: ' . strlen($xml)
		]); */

		// Eksekusi permintaan cURL
		/* $response = curl_exec($ch);
		curl_close($ch);

		// Menampilkan respons dari server
		if ($response === false) {
			echo 'Error cURL: ' . curl_error($ch);
		} else {
			echo 'Respon dari server:<br>';
			echo htmlspecialchars($response);
		} */


		$IP = '192.168.131.150';
		$zk = new ZKTeco($IP, 4370);
		#$zk = new ZktecoLib($IP, 8080);		
		$zk->connect();

		//Connect
		//this return bool
		//Disconnect
		//$zk->connect()


		// this is return bool
		//Device Enable
		//$zk->disconnect()


		// this is return bool//mixed
		//Device Disable
		//$zk->deviceEnable()


		// this is return bool//mixed
		//Face Function On
		//$zk->deviceDisable()


		// this is return bool//mixed
		//Device Restart
		//$zk->faceFunctionOn()


		// this is return bool//mixed
		//Device Serial Number
		//$zk->restart()

		//get device serial number
		//Device Name
		//$zk->serialNumber()

		//get device name
		//Device PIN Width
		//$zk->deviceName()

		//get device pin width
		//Device SSR
		//$zk->pinWidth()

		//get device ssr
		//Device Work Code
		//$zk->ssr()

		//get device work code
		//Device Firmware Version
		//$zk->workCode()

		//get device fmVersion
		//Device Platform
		//$zk->fmVersion()

		//get device platform
		//Get Attendance
		//$zk->platform()


		//return array[]
		//Clear Attendance
		//$zk->getAttendance()


		//   return bool/mixed
		//Clear Admin
		//$zk->clearAttendance()


		//remove all admin
		//return bool|mixed
		//Clear User
		//$zk->clearAdmin()


		//remove all users
		//return bool|mixed
		//Get User
		//$zk->clearUser()


		//get User  //this return array[]
		//Delete User
		//$zk->getUser()


		//parameter integer $uid  //return bool|mixed
		//Set/Add User
		//$zk->deleteUser()


		//1 s't parameter int $uid Unique ID (max 65535)
		//2 nd parameter int|string $userid ID in DB (same like $uid, max length = 9, only numbers - depends device setting)
		//3 rd parameter string $name (max length = 24)
		//4 th parameter int|string $password (max length = 8, only numbers - depends device setting)
		//5 th parameter int $role Default Util::LEVEL_USER  //return bool|mixed
		//
		//$zk->setUser()

		//$zk->restart();
		//$getAttendance = $zk->getAttendance();

		dd($zk->connect(),$zk->enableDevice(),$zk->faceFunctionOn(),$zk->serialNumber(),$zk->deviceName(),$zk->pinWidth(),$zk->ssr(),$zk->workCode(),$zk->fmVersion(),$zk->platform(),$zk->getAttendance(),$zk->getUser());
	}
}
