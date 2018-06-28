<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Redis;
use App\Services\Tag;

class TagController extends Controller
{
    private $tag;
    public function __construct(Tag $tag)
    {
        $this->tag = $tag;
    }

    public function index(){
        $tags = $this->tag->tags();
        $tags = collect($tags)->map(function($tag){
            return ['id' => $tag['id'],'name' => $tag['name'], 'number' => Redis::SCARD($tag['id'].":posts")];
        });
        return response()->json($tags);
    }
}
