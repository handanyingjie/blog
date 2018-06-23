<?php

namespace App\Http\Controllers\Home;

use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TagController extends Controller
{
    public function index(){
        $tags = Tag::get();
        return response()->json($tags);
    }
}
