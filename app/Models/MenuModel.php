<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class MenuModel extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $table = 'menus'; // Nama tabel dalam database

    protected $fillable = [
        "id","menu_group_id","parent_id","code","title"
    ];

	public function submenu(){
		$roles = Auth()->user()->roles->collect()->pluck('name')->toArray();
		$menu_group = DB::table('menu_groups')->whereIn('role',$roles)->get();
		$menu_group_ids = $menu_group?->collect()->pluck('id');

		return $this->hasMany(MenuModel::class,'parent_id')->orderBy('sort_order')->whereIn('menu_group_id',$menu_group_ids);
	}
}
