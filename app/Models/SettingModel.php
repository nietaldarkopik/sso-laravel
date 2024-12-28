<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingModel extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $table = 'settings'; // Nama tabel dalam database

    protected $fillable = [
        "nama","jabatan","jenis_kelamin","id_unit","photo"
    ];
}
