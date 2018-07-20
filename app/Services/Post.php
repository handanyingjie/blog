<?php

namespace App\Services;

use App\Services\Base;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class Post extends Base {

    public function generatePost($key,$data){
        $now = date('Y-m-d H:i:s');
        $this->redis->HMSET($key,collect($data)->merge([
            'slug' => $data['title'],
            'user_id' => Auth::user()->id,
            'published' => 0,
            'created_at' => $now,
            'updated_at' => $now,
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
        $max =  $this->redis->GET('posts:count');

        $posts = [];
        for($i =1; $i <= $max; $i++){
            if($this->redis->EXISTS("post:$i")){
                $posts[] = [
                    'title' => $this->redis->HGET("post:$i",'title'),
                    'author' => $this->redis->HGET("post:$i",'author'),
                    'created_at' => $this->redis->HGET("post:$i",'created_at'),
                    'updated_at' => $this->redis->HGET("post:$i",'updated_at'),
                    'id' => "post:$i",
                    'published' => $this->redis->HGET("post:$i",'published'),
                ];
            }
        }
        return $posts;
//        return collect($this->redis->LRANGE('posts:list',0, -1))->map(function($key){
//            return [
//                'title' => $this->redis->HGET($key,'title'),
//                'author' => $this->redis->HGET($key,'author'),
//                'created_at' => $this->redis->HGET($key,'created_at'),
//                'updated_at' => $this->redis->HGET($key,'updated_at'),
//                'id' => $key,
//                'published' => $this->redis->HGET($key,'published'),
//            ];
//        });
    }

    public function postsList($key){
        $this->redis->LPUSH('posts:list',$key);
    }
}