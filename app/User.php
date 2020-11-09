<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Cache;
use Auth;
use DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','role_id','category','last_login_at',
        'last_login_ip','user_online'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getUserPermisions(){
        $empty_permissions_array = [];
        $permissions_array = DB::table('permission_roles')
        ->join('permissions','permissions.id','permission_roles.permission_id')
        ->where('role_id',Auth::user()->role_id)
        ->select('permissions.Permissions')->get();
        foreach(json_decode($permissions_array,true) as $permissions){
                array_push($empty_permissions_array,$permissions["Permissions"]);
        }
        return $empty_permissions_array;
    }
}
