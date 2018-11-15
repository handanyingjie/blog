<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $guarded = [];
    protected $fillable = ['post_id','nickname','body','body'];

//    public function user(){
//        return $this->belongsTo(User::class,'user_id','id')->withDefault();
//    }

    public function post(){
        return $this->belongsTo(Post::class,'post_id','id')->withDefault();
    }
}
