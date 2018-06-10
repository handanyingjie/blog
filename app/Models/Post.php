<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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

    public function createPost(array $data){
        $post = $this->create(collect($data)->merge([
            'slug' => $data['title'],
            'user_id' => Auth::user()->id
        ])->toArray());
        $post->tags()->attach($data['tag_id']);
        return $post;
    }

    public function updatePost(array $data){
        $post = $this->update(collect($data)->merge([
            'slug' => $data['title'],
            'user_id' => Auth::user()->id
        ])->toArray());

        $this->tags()->sync($data['tag_id']);
        return $post;
    }
}
