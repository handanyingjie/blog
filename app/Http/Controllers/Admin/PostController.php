<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Post\CreateRequest;
use App\Http\Requests\Admin\Post\UpdateRequest;
use App\Repository\AdminRepostiry;
use App\Events\Post\Created;
use App\Events\Post\Delete;
use App\Events\Post\Published;
use App\Events\Post\UnPublished;
use App\Events\Post\Update;
use App\Services\Tag;
use App\Services\Post;
use Illuminate\Support\Facades\Redis;

class PostController extends Controller
{
    private $tag;
    private $post;
    private $redis;
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
        $posts = $this->post->posts();
        return view('admin.post.index', compact('posts'));
    }

    public function create()
    {
        $tags = $this->tag->tags();
        $is_top = self::IS_TOP_ARR;
        return view('admin.post.create', compact('tags', 'is_top'));
    }

    public function store(CreateRequest $request)
    {
        Redis::MULTI();
        $id = $this->post->generateTagKey('posts:count');
        $this->post->generatePost("post:$id", $request->except(['_token', '_method', 'tag_id']));

        $this->redis->generateTagPosts($request->tag_id, "post:$id");
        Redis::EXEC();
        return redirect()->route('post_index');
    }

    public function edit($id)
    {
        $tags = $this->tag->tags();
        $is_top = self::IS_TOP_ARR;
        $tag_id = Redis::SMEMBERS("$id:tags");
        $post = $this->post->post($id);
        return view('admin.post.edit', compact('post', 'tags', 'is_top', 'tag_id', 'id'));
    }

    public function update(UpdateRequest $request, $id)
    {
        Redis::MULTI();
        $this->post->generatePost($id, collect($request->except(['_token', '_method', 'tag_id'])));
        $this->tag->updateTagPosts([], $request->tag_id, $id);
        Redis::EXEC();
        return redirect()->route('post_index');
    }

    public function destroy($id)
    {
        $this->post->del($id);
        return back();
    }

    public function published($id)
    {
        Redis::MULTI();
        Redis::HSET($id, 'published', 1);
        event(new Published($id));
        Redis::EXEC();
        return back();
    }

    public function unPublished($id)
    {
        Redis::MULTI();
        Redis::HSET($id, 'published', 0);

        event(new UnPublished($id));
        Redis::EXEC();
        return back();
    }
}
