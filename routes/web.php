<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\UnitController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\UbahPasswordController;
use App\Http\Controllers\Admin\AbsensiUserController;
use App\Http\Controllers\Admin\AbsensiDeviceController;
use App\Http\Controllers\Admin\AbsensiDeviceUserController;
use App\Http\Controllers\Admin\AbsensiAttendenceController;
use App\Http\Controllers\Admin\AbsensiAttendenceLogController;
use App\Http\Controllers\Admin\AbsensiLogController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\AbsensiLaporanController;
use App\Http\Controllers\ADMSController;
use App\Http\Controllers\Front\ServiceADMSController;
use App\Http\Controllers\GoogleAuthController;

Route::get('auth/google', [GoogleAuthController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [GoogleAuthController::class, 'handleGoogleCallback']);

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [App\Http\Controllers\HomeController::class,'index']);
Route::get('/test-date', [App\Http\Controllers\Front\PageController::class,'test']);
//Route::get('absen', [App\Http\Controllers\HomeController::class,'index']);

Auth::routes();

Route::prefix('admin')->name('admin.')->group(function(){
    Route::resource('laporan',LaporanController::class);
    Route::resource('unit',UnitController::class);
	Route::post('unit/generate-code',[UnitController::class,'generateCode'])->name('unit.generateCode');
    Route::post('unit/update-sort',[UnitController::class,'updateSort'])->name('unit.updateSort');
    Route::resource('roles',RolesController::class);
    Route::resource('users',UsersController::class);
    Route::resource('ubah-password',UbahPasswordController::class);

	Route::get('absensi_user/check-from-device/{id_device}',[AbsensiUserController::class,'checkFromDevice'])->name('absensi_user.checkFromDevice');
	Route::get('absensi_user/from-device',[AbsensiUserController::class,'fromDevice'])->name('absensi_user.fromDevice');
	Route::post('absensi_user/from-device',[AbsensiUserController::class,'storeFromDevice'])->name('absensi_user.fromDevice');
	
	Route::resource('absensi_user',AbsensiUserController::class);
	Route::resource('absensi_device',AbsensiDeviceController::class);
	Route::resource('absensi_device_user',AbsensiDeviceUserController::class);
	Route::resource('absensi_attendence',AbsensiAttendenceController::class);
	Route::resource('absensi_attendence_log',AbsensiAttendenceLogController::class);
	Route::resource('absensi_log',AbsensiLogController::class);
	Route::resource('laporan',AbsensiLaporanController::class);
	Route::resource('setting',SettingController::class);

	Route::get('absensi_attendence/print',[AbsensiAttendenceController::class,'print'])->name("absensi_attendence.print");
	Route::get('absensi_attendence/pdf',[AbsensiAttendenceController::class,'pdf'])->name("absensi_attendence.pdf");
	Route::get('absensi_attendence_log/print',[AbsensiAttendenceLogController::class,'print'])->name("absensi_attendence_log.print");
	Route::get('absensi_attendence_log/pdf',[AbsensiAttendenceLogController::class,'pdf'])->name("absensi_attendence_log.pdf");

	Route::get('/attendances/data', [App\Http\Controllers\Admin\DashboardController::class, 'getAttendances'])->name('dashboard.getAttendances');
	Route::get('/attendance_recaps/data', [App\Http\Controllers\Admin\DashboardController::class, 'getAttendanceRecaps'])->name('dashboard.getAttendanceRecaps');

})->middleware('auth');


//Route::get('/adms//iclock/getrequest{params1?}', [App\Http\Controllers\ADMSController::class, 'getrequest'])->name('adms.getRequests');
//Route::get('/adms/iclock/getrequest{params1?}', [App\Http\Controllers\ADMSController::class, 'getrequest'])->name('adms.getRequests2');
Route::post('/adms/{params1?}', [App\Http\Controllers\ADMSController::class, 'index'])->where('params1', '.*')->name('post_adms');
Route::get('/adms/{params1?}', [App\Http\Controllers\ADMSController::class, 'index'])->where('params1', '.*')->name('get_adms');
Route::get('/home', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('home');

Route::prefix('service')->name('front.')->group(function(){
	Route::get('device/data',[ServiceADMSController::class,'device_data'])->name("device.data");
	Route::get('presensi/data',[ServiceADMSController::class,'presensi_data'])->name("presensi.data");
	Route::get('ping/device',[ServiceADMSController::class,'ping_device'])->name("presensi.ping_device");
	Route::get('presensi/last_present',[ServiceADMSController::class,'last_present'])->name("presensi.last_present");
	Route::get('profile-log',[ADMSController::class,'profile'])->name("presensi.profile");
	Route::get('tts', [ServiceADMSController::class, 'fetchTTS'])->name("presensi.tts");

});
