<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbsensiUserModel extends Model
{
    public $timestamps = true;
    use HasFactory;
    protected $table = 'absensi_users'; // Nama tabel dalam database

    protected $fillable = [
        "raw","nama","jabatan","jenis_kelamin","id_unit","photo","created_at","updated_at"
    ];

	public function device(){
		return $this->belongsTo(AbsensiDeviceUserModel::class,'id','id_user');
	}
	public function unit(){
		return $this->belongsTo(UnitModel::class,'id_unit');
	}
	public function presensi(){
		return $this->hasMany(AbsensiAttendenceModel::class,'id_user');
	}
}
