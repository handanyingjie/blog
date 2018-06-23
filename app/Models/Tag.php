<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['name','slug'];

    public $timestamps = false;

    public function posts(){
        return $this->morphedByMany(Post::class,'taggable');
    }

    public function tags(){
        return $this->get();
    }
}
