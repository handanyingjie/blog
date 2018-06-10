<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'name','slug','permissions'
    ];
    protected $casts = [
        'permissions' => 'array'
    ];

    public function scopeNotAdmin(){
        return $this->where('slug','!=','admin');
    }

    public function general(){
        return $this->notAdmin()->get();
    }

    public function users(){
        return $this->belongsToMany(User::class,'user_roles','role_id','user_id');
    }

    public function hasAccess($permission){
        return $this->hasPermission($permission);
    }

    public function hasPermission($permission){
        return isset($this->permissions[$permission]) ? $this->permissions[$permission] : false;
    }
}
