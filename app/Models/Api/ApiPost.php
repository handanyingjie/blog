<?php

namespace App\Models\Api;

use App\Models\Post;
use Carbon\Carbon;

class ApiPost extends Post{
    protected $table = 'posts';
    public function getCreatedAtAttribute($date){
        if(Carbon::now() > Carbon::parse($date)->addDays(15)){
            return Carbon::parse($date);
        }
        return Carbon::parse($date)->diffForHumans();
    }
}