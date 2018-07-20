<?php

namespace App\Http\Controllers\Home;

use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest()->get();
        return view('home.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
//        $post['id'] = $id;
//
//        list($title, $published_at, $body) = Redis::HMGET($id,['title','published_at','body']);
//        $post['title'] = $title;
//        $post['created_at'] = Carbon::parse(date('Y-m-d H:i:s',$published_at))->toDateString();
//        $post['body'] = \Parsedown::instance()->text($body);
//
//        Redis::HINCRBY($id, 'looks', 1);
//        Redis::ZINCRBY('readRank',1, $id);
//        $post['looks'] = Redis::ZSCORE('readRank',$id);
//        $post['uid'] = 0;
//        if(isset($_COOKIE['laravel_cookie'])){
//            $data['uid'] = decrypt($_COOKIE['laravel_cookie']);
//        }
        $post->body = \Parsedown::instance()->text($post->body);
        return response()->json($post);
    }

    private function generatePageLink($id,$max,$symbol = true){
        if($id < 1)
        $suffix = true === $symbol ? $id++ : $id --;
        $key = "post:$suffix";
        if(Redis::exists($key)) {
            return $key;
        }

        $this->generatePageLink($id,$symbol);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
