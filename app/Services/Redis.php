<?php

namespace App\Services;

use Illuminate\Support\Facades\Redis;

class Base {
    private $redis;

    public function __construct()
    {
        $this->redis = Redis::connection();
    }
}