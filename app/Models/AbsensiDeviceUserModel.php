<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbsensiDeviceUserModel extends Model
{
    public $timestamps = true;
    use HasFactory;
    protected $table = 'absensi_device_users'; // Nama tabel dalam database

    protected $fillable = [
        "raw","id_device","device_no","id_user","user_no","device_user_name","passwd","created_at","updated_at"
    ];

	public function device(){
		return $this->belongsTo(AbsensiDeviceModel::class,'id_device');
	}

	public function user(){
		return $this->belongsTo(AbsensiUserModel::class,'id_user');
	}
}