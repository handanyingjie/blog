<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
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
        $post->tags()->attach($data['tag_id']);

        //更新redis,标签对应的total加1
        collect($data['tag_id'])->each(function($id){
            if(Redis::EXISTS("tag:$id")) {
                Redis::HINCRBY("tag:$id",'total',1);
            }
        });
    }

    public function updatePost(array $data){
        $this->update(collect($data)->merge([
            'slug' => $data['title'],
            'user_id' => Auth::user()->id
        ])->toArray());

        //久标签大于新标签为减，否则为增
        $oldTag = $this->tags->pluck(['id'])->toArray();
        $oldTagLen = count($oldTag);
        $newTagLen = count($data['tag_id']);
        if($oldTagLen > $newTagLen){
            collect($oldTag)
                ->diff($data['tag_id'])
                ->each(function($id){
                Redis::HINCRBY("tag:$id","total",-1);
            });
        } elseif($oldTagLen < $newTagLen) {
            collect($data['tag_id'])
                ->diff($oldTag)
                ->each(function($id){
                Redis::HINCRBY("tag:$id","total",1);
            });
        }
        return $this->tags()->sync($data['tag_id']);
    }
}
