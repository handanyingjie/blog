<?php
/**
 * Created by PhpStorm.
 * User: liuyingjie
 * Date: 2018/6/10 0010
 * Time: 13:51
 */

namespace App\Observes;


use App\Models\Post;

class PostObserver
{
    public function deleting(Post $post){
        $post->tags()->detach();
    }
}