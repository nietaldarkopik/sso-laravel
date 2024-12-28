<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UnitModel extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $table = 'units'; // Nama tabel dalam database

    protected $fillable = [
        'code','parent_code','nama','keterangan','sort_order'
    ];

	public function sub()
	{
		return $this->hasMany('Category', 'parent_code', 'code');
	}

	public function parent()
	{
		return $this->belongsTo('Category', 'parent_code');
	}

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_units', 'id_unit', 'id_user');
    }
}
