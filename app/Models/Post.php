<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;

class Post extends Model
{
    public $top = [
        1 => '是',
        2 => '否'
    ];

    protected $fillable = ['title','author','is_top','body','slug','user_id'];
    
    public function tags(){
        return $this->morphToMany(Tag::class,'taggable');
    }

    public function scopePublished($query){
        return $query->where('published',1);
    }

    public function replies(){
        return $this->hasMany(Reply::class,'post_id','id');
    }
    public function createPost(array $data){
        $post = $this->create(collect($data)->merge([
            'slug' => $data['title'],
            'user_id' => Auth::user()->id
        ])->toArray());
        return $post->tags()->attach($data['tag_id']);
    }

    public function updatePost(array $data){
        $this->update(collect($data)->merge([
            'slug' => $data['title'],
            'user_id' => Auth::user()->id
        ])->toArray());
        return $this->tags()->sync($data['tag_id']);
    }
}
