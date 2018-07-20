<?php

namespace App;

use App\Models\Reply;
use App\Models\Role;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','api_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles(){
        return $this->belongsToMany(Role::class,'user_roles','user_id','role_id');
    }
    public function replies(){
        return $this->hasMany(Reply::class,'user_id','id');
    }

    public function hasAccess($permission){
        return $this->hasPermission($permission);
    }

    public function hasPermission($permission){
        foreach($this->roles as $role){
            if($role->hasAccess($permission)){
                return true;
            }
        }
        return false;
    }
}
