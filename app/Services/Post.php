<?php

namespace App\Services;

use App\Services\Base;
use Illuminate\Support\Facades\Auth;

class Post extends Base {

    public function generatePost($key,$data){
        $this->redis->HMSET($key,collect($data)->merge([
            'slug' => $data['title'],
            'user_id' => Auth::user()->id
        ])->toArray());
        return $key;
    }

    public function post($key){
        return [
            'title' => $this->redis->HGET($key,'title'),
            'author' => $this->redis->HGET($key,'author'),
            'body' => $this->redis->HGET($key,'body'),
            'is_top' => $this->redis->HGET($key,'is_top'),
            'created_at' => $this->redis->HGET($key,'created_at'),
            'updated_at' => $this->redis->HGET($key,'updated_at'),
            'published' => $this->redis->HGET($key,'published'),
        ];
    }

    public function posts(){
        return collect($this->redis->LRANGE('posts:list',0, -1))->map(function($key){
            return [
                'title' => $this->redis->HGET($key,'title'),
                'author' => $this->redis->HGET($key,'author'),
                'created_at' => $this->redis->HGET($key,'created_at'),
                'updated_at' => $this->redis->HGET($key,'updated_at'),
                'id' => $key,
                'published' => $this->redis->HGET($key,'published'),
            ];
        });
    }

    public function postsList($key){
        $this->redis->LPUSH('posts:list',$key);
    }
}