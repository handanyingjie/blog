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
    public function index($tag_id, $offset, $count)
    {
        $offset = ($offset- 1) * $count;
        if ($tag_id) {
            Redis::DEL('tmp:search');   //每次搜索前先删除 tmp:search
            Redis::SINTERSTORE('tmp:search', 'posts:list',$tag_id.":posts");    //求已发布文章跟属于该标签的文章的交集,并存入 tmp:search
            $idArr = Redis::SORT('tmp:search', ['BY' => '*->published_at', 'SORT' => "DESC", "LIMIT" => [$offset, $count], 'ALPHA' => true]);
            $total = Redis::SCARD('tmp:search');
        } else {
            $idArr = Redis::SORT('posts:list', ['BY' => '*->published_at', 'SORT' => "DESC", "LIMIT" => [$offset, $count], 'ALPHA' => true]);
            $total = Redis::SCARD('posts:list');
        }

        $max = count($idArr) - 1;
        $posts = collect($idArr)->map(function ($key, $index) use ($max, $idArr) {
            $post['id'] = $key;
            $post['title'] = Redis::HGET($key, 'title');
            $post['created_at'] = Carbon::parse(date('Y-m-d H:i:s', Redis::HGET($key, 'published_at')))->diffForHumans();

            if ($max < 2) {
                $post['prev'] = $post['next'] = $idArr[0];
            } else {
                if (0 === $index) {
                    $post['prev'] = $idArr[$index];
                    $post['next'] = $idArr[$index + 1];
                } elseif ($max === $index) {
                    $post['prev'] = $idArr[$index - 1];
                    $post['next'] = $idArr[$index];
                } else {
                    $post['prev'] = $idArr[$index - 1];
                    $post['next'] = $idArr[$index + 1];
                }

                Redis::MULTI();
                Redis::HSET($key, 'prev', $post['prev']);
                Redis::HSET($key, 'next', $post['next']);
                Redis::EXEC();
            }

            return $post;
        });
        $data['posts'] = $posts;
        $data['total'] = $total;
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
}
