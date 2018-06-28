<?php

namespace App\Services;

use Illuminate\Support\Facades\Redis;

class Tag
{
    private $redis;

    public function __construct()
    {
        $this->redis = Redis::connection();
    }

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
     * 生成自增tag id
     * @return integer
     */
    private function generateTagKey()
    {
        return $this->redis->INCR('tags:count');
    }

    /**
     * 返回所有标签
     * @return \Illuminate\Support\Collection
     */
    public function tags()
    {
        return collect($this->redis->KEYS('tag:*'))->map(function ($key) {
            return ['id' => $key, 'name' => $this->redis->HGET($key, 'name')];
        });
    }

    public function tag($key){
        return $this->redis->HGET($key, 'name');
    }

    public function del($key){
        return $this->redis->DEL($key);
    }
}