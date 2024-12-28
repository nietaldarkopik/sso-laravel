<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;
use DB;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

	public function units()
    {
        return $this->belongsToMany(UnitModel::class, 'user_units','id_user','id_unit')->whereNull('user_units.deleted_at');
    }

    public function rolesWithinTeam($teamId)
    {
        return $this->roles()->wherePivot('unit_id', $teamId)->get();
    }

    public function assignUnit($units)
    {
		//$user = $this->get()->first();
		UserUnitModel::where('id_user',$this->id)->delete();

		foreach($units as $i => $u)
		{
			UserUnitModel::create([
				'id_user' => $this->id,
				'id_unit' => $u
			]);
		}

        return $this;
    }

    public function assignUnitRole($units,$roles)
    {
		$user = $this;

		DB::table("user_unit_roles")->where(function($query) use ($user) { $query->where('id_user',$user->id); })->delete();

		foreach($roles as $ir => $r)
		{
			foreach($units as $i => $u)
			{
				$role = Role::where('name',$r)->get()->first();
				UserUnitRoleModel::create([
					'id_user' => $user->id,
					'id_role' => $role->id,
					'id_unit' => $u
				]);
			}
		}

        return $this;
    }
}
