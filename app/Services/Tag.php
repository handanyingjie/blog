<?php

namespace App\Services;

use App\Services\Base;

class Tag extends Base
{
    /**
     * 创建标签
     *  key tag:id
     * @param $value string
     */
    public function generateTags($key, $value)
    {
        $this->redis->HSET($key, 'name', $value);
    }

    /**
     * 返回所有标签
     * @return \Illuminate\Support\Collection
     */
    public function tags()
    {
        $max = $this->redis->GET('tags:count');
        $tags = [];
        for($i = 1; $i <= $max; $i++){
            if($this->redis->EXISTS("tag:$i")){
                $tags[] = ['id' => "tag:$i", 'name' => $this->redis->HGET("tag:$i",'name')];
            }
        }
        return $tags;
    }

    public function tag($key){
        return $this->redis->HGET($key, 'name');
    }

    public function generateTagPosts($value, $post_id){
        collect($value)->each(function($key) use ($post_id){
            $this->redis->SADD("$key:posts",$post_id);
            $this->redis->SADD("$post_id:tags",$key);
        });
    }

    public function updateTagPosts(array $old, array $new, $post_id){
        if($old !== $new){
            collect($new)->each(function($key) use ($post_id){
                $this->del("$key:posts");
                $this->del("$post_id:tags");
            });
            $this->generateTagPosts($new, $post_id);
        }
    }
}