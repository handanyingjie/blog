<?php
/**
 * Created by PhpStorm.
 * User: liuyingjie
 * Date: 2018/6/10 0010
 * Time: 13:51
 */

namespace App\Observes;


use App\Models\Tag;
use Illuminate\Support\Facades\Redis;

class TagObserver
{
    public function created(Tag $tag){
        Redis::HMSET("tag:$tag->id",
            collect($tag)->except(['id','slug'])
                ->merge(['total' => 0])
                ->toArray()
        );
    }

    public function deleted(Tag $tag){
        Redis::DEL("tag:$tag->id");
    }
}