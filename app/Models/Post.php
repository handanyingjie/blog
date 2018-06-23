<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    public $top = [
        1 => '是',
        2 => '否'
    ];

    protected $fillable = ['title','author','is_top','body','slug','user_id'];

    public function getCreatedAtAttribute($date){
        if(Carbon::now() > Carbon::parse($date)->addDays(15)){
            return Carbon::parse($date);
        }
        return Carbon::parse($date)->diffForHumans();
    }

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
