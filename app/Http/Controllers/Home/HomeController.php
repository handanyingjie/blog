<?php

namespace App\Http\Controllers\Home;

use App\Models\Api\ApiPost;
use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Redis;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($tag_id = 0)
    {
        if ($tag_id) {
            $idArr = Redis::SORT($tag_id . ":posts", ['BY' => '*->published_at', 'SORT' => "DESC", "LIMIT" => [0, 20], 'ALPHA' => true]);
        } else {
            $idArr = Redis::SORT('posts:list', ['BY' => '*->published_at', 'SORT' => "DESC", "LIMIT" => [0, 20], 'ALPHA' => true]);
        }

        $posts = collect($idArr)->filter(function ($key) {
            return Redis::HGET($key, 'published') === '1';
        })->map(function ($key) {
            $post['id'] = Redis::HGET($key, 'id');
            $post['title'] = Redis::HGET($key, 'title');
//            $post['created_at'] = Carbon::parse(date('Y-m-d H:i:s',Redis::HGET($key, 'published_at')))->diffForHumans();
            $post['created_at'] = Carbon::parse(date('Y-m-d H:i:s', Redis::HGET($key, 'published_at')))->diffForHumans();
            return $post;
        });
        return response()->json($posts);
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
                $post['id'] = Redis::HGET($key, 'id');
                $post['title'] = Redis::HGET($key, 'title');
                $post['looks'] = $value ?: 0;
                return $post;
            });
        return response()->json($posts);
    }
}
