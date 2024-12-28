<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserUnitModel extends Model
{
	use SoftDeletes;
	
    public $timestamps = true;
    use HasFactory;
    protected $table = 'user_units'; // Nama tabel dalam database

    protected $fillable = [
        'id_user','id_unit'
    ];
}
