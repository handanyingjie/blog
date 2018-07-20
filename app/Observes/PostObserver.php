<?php
/**
 * Created by PhpStorm.
 * User: liuyingjie
 * Date: 2018/6/10 0010
 * Time: 13:51
 */

namespace App\Observes;


use App\Models\Post;
use App\Models\Tag;
use App\Models\Tagggable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class PostObserver
{
    public function deleting(Post $post){
//        $post->tags()->detach();
//        Tag::whereIn('id', $tag_id)->decrement('total');
    }
}