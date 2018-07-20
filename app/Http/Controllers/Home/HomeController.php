<?php

namespace App\Http\Controllers\Home;

use App\Models\Api\ApiPost;
use App\Models\Post;
use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Redis;
use App\Jobs\SendEmail;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($tag_id, $offset, $count)
    {
//        $offset = ($offset- 1) * $count;
//
//        //此处调用Lua脚本
//        $client = new \Predis\Client();
//        $client->getProfile()->defineCommand('hmgetall','App\Services\Lua\Demo');
//        $value = $client->hmgetall($tag_id,$offset, $count);
//
//        $data['posts'] = collect($value[0])->map(function($item){
//            list($title, $published_at, $id) = $item;
//            return [
//                'title' => $title,
//                'created_at' => Carbon::parse(date('Y-m-d H:i:s',$published_at))->diffForHumans(),
//                'id' => $id
//            ];
//        });
//        $data['total'] = $value[1];
//        $data['uid'] = 0;
//        if(isset($_COOKIE['laravel_cookie'])){
//            $data['uid'] = decrypt($_COOKIE['laravel_cookie']);
//        }

        $data = Post::published()
            ->latest('published_at')
            ->get(['id','title','published_at'])->flatmap(function ($item){
                $item->published_at = Carbon::parse($item->published_at)->diffForHumans();
                return [$item];
            });
        return response()->json($data);
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
    public function show($id)
    {
        //
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

    public function readRank()
    {
        $posts = collect(Redis::ZREVRANGEBYSCORE('readRank', '+inf', '-inf', 'WITHSCORES', 'LIMIT', 0, 10))
            ->map(function ($value, $key) {
                $post['id'] = $key;
                $post['title'] = Redis::HGET($key, 'title');
                $post['looks'] = $value ?: 0;
                return $post;
            });
        return response()->json($posts);
    }

    public function email(Request $request){
       $this->dispatch(new SendEmail($request->except(['_token'])));
       return response()->json('ok');
    }
}
