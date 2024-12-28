<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbsensiAttendenceLogModel extends Model
{
    public $timestamps = true;
    use HasFactory;
    protected $table = 'absensi_attendence_logs'; // Nama tabel dalam database

    protected $fillable = [
        "id_device","id_user","user_no","device_no","waktu","created_at","updated_at"
    ];

	public function device(){
		return $this->belongsTo(AbsensiDeviceModel::class,'id_device');
	}

	public function user(){
		return $this->belongsTo(AbsensiUserModel::class,'id_user');
	}
}
