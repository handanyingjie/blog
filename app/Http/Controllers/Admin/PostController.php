<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Post\CreateRequest;
use App\Http\Requests\Admin\Post\UpdateRequest;
use App\Models\Post;
use App\Models\Tag;
use App\Repository\AdminRepostiry;
use App\Events\Post\Created;
use App\Events\Post\Delete;
use App\Events\Post\Published;
use App\Events\Post\UnPublished;
use App\Events\Post\Update;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class PostController extends Controller
{
    private $tag;
    private $post;
    const IS_TOP_ARR = [
        1 => '是',
        2 => '否'
    ];

    public function __construct(AdminRepostiry $admin, Tag $tag, Post $post)
    {
        $this->middleware('auth');
        $this->admin = $admin;
        $this->tag = $tag;
        $this->post = $post;
    }

    public function index()
    {
        $posts = $this->post->latest()
            ->get(['title','author','created_at','id','published','published_at']);
        return view('admin.post.index', compact('posts'));
    }

    public function create()
    {
        $tags = $this->tag->all();
        $is_top = self::IS_TOP_ARR;
        return view('admin.post.create', compact('tags', 'is_top'));
    }

    public function store(Request $request)
    {
        $this->post->createPost($request->except(['_token']));
        return redirect()->route('post_index');
    }

    public function edit($id)
    {
        $is_top = self::IS_TOP_ARR;                                     //是否置顶
        $tags = $this->tag->all();                                      //标签
        $post = $this->post->with('tags')->find($id);         //文章
        $tag_id = $post->tags->flatmap(function ($item){               //文章所属标签
            return [$item->id];
        })->toArray();
        return view('admin.post.edit', compact('post', 'tags', 'is_top', 'tag_id', 'id'));
    }

    public function update(UpdateRequest $request, \App\Models\Post $post)
    {
        $post->updatePost($request->except(['_token', '_method']));
        return redirect()->route('post_index');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return back();
    }

    public function published(Post $post)
    {
        $post->published = 1;
        $post->published_at = Carbon::now();
        $post->save();
        return back();
    }

    public function unPublished(Post $post)
    {
        $post->published = 0;
        $post->save();
        return back();
    }
}
