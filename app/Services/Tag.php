<?php

namespace App\Services;

use App\Services\Base;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

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
        $keys = $this->redis->KEYS('tag:*');

        $tags = collect($keys)->flatMap(function($key){
            $id = str_replace("tag","",$key);
            return [collect(Redis::HGETALL($key))->merge(['id' => $id])->toArray()];
        });
        return $tags;
    }

    public function tag($key){
        return $this->redis->HGET($key, 'name');
    }

    public function generateTagPosts($value, $post_id){
        collect($value)->each(function($key) use ($post_id){
            Log::info("$key:posts");
            Log::info("$post_id:tags");
            $this->redis->SADD("$key:posts",$post_id);
            $this->redis->SADD("$post_id:tags",$key);
        });
    }

    public function updateTagPosts(array $old, array $new, $post_id){
        if($old !== $new){
            collect($new)->each(function($key) use ($post_id){
                $this->redis->SREM("$key:posts",$post_id);
                $this->redis->SREM("$post_id:tags",$key);
            });
            $this->generateTagPosts($new, $post_id);
        }
    }
}