<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserUnitRoleModel extends Model
{
	use SoftDeletes;
    public $timestamps = true;
    use HasFactory;
    protected $table = 'user_unit_roles'; // Nama tabel dalam database

    protected $fillable = [
        'id_unit','id_role','id_user'
    ];
}
