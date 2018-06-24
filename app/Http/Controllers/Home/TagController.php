<?php

namespace App\Http\Controllers\Home;

use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Redis;

class TagController extends Controller
{
    public function index(){
        $tags = Redis::HGETALL('tags');
        $arr = [];
        collect($tags)->each(function($tag) use (&$arr){
            $newArr = json_decode($tag,true);
            array_push($arr,['id' => $newArr['id'],'name' => $newArr['name'], 'number' => $newArr['number']]);
        });
        return response()->json($arr);
    }
}
