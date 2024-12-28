<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbsensiDeviceModel extends Model
{
    public $timestamps = true;
    use HasFactory;
    protected $table = 'absensi_devices'; // Nama tabel dalam database

    protected $fillable = [
        "raw","device_no","device_name","sn","ip_public","ip_local","port_public","port_local","location","status","created_at","updated_at"
    ];
}
