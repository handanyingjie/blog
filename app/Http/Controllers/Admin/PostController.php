<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Post\CreateRequest;
use App\Http\Requests\Admin\Post\UpdateRequest;
use App\Models\Post;
use App\Models\Tag;
use App\Repository\AdminRepostiry;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    private $tag;
    private $post;
    public function __construct(AdminRepostiry $admin,Tag $tag,Post $post)
    {
        $this->middleware('auth');
        $this->admin = $admin;

        $this->tag = $tag;
        $this->post = $post;
    }

    public function index(){
        $posts = $this->post->published()->latest()->get(['title','author','created_at','updated_at','id']);
        return view('admin.post.index',compact('posts'));
    }
    public function create(){
        $tags = $this->tag->tags();
        $is_top = $this->post->top;
        return view('admin.post.create',compact('tags','is_top'));
    }
    public function store(CreateRequest $request){
        $this->post->createPost($request->except(['_token']));
        return redirect()->route('post_index');
    }

    public function edit(Post $post){
        $tags = $this->tag->tags();
        $is_top = $this->post->top;
        $tag_id = $post->tags->pluck(['id'])->toArray();
        return view('admin.post.edit',compact('post','tags','is_top','tag_id'));
    }

    public function update(UpdateRequest $request,Post $post){
       $post->updatePost($request->except(['_token']));
        return redirect()->route('post_index');
    }

    public function destroy(Post $post){
        $post->delete();
        return back();
    }
}
