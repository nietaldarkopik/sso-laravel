<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbsensiLogModel extends Model
{
    public $timestamps = true;
    use HasFactory;
    protected $table = 'absensi_logs'; // Nama tabel dalam database

    protected $fillable = [
        "the_post","the_get","the_request","the_server","the_raw","user_agent","created_at","updated_at"
    ];
}
