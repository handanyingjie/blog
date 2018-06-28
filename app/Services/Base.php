<?php

namespace App\Services;

use Illuminate\Support\Facades\Redis;

class Base {
    protected $redis;

    public function __construct()
    {
        $this->redis = Redis::connection();
    }

    /**
     * 生成自增tag id
     * @return integer
     */
    public function generateTagKey($key)
    {
        return $this->redis->INCR($key);
    }

    public function del($key){
        return $this->redis->DEL($key);
    }
}

