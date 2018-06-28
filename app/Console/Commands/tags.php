<?php

namespace App\Console\Commands;

use App\Models\Tag;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class tags extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:tags';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Redis::DEL('posts_tags');
        Redis::DEL('tags');

        Tag::get()->each(function ($tag){
//            $number = $tag->posts()->count();
            $key = Redis::INCR('tags:count');
            Redis::HSET('tag:'.$key,'name',$tag->name);
        });
//        $res = DB::table('taggables')
//                    ->leftjoin('posts','taggables.taggable_id','posts.id')
//                    ->where('posts.published',1)
//                    ->get(['taggables.taggable_id','taggables.tag_id','posts.id']);
//
//        $posts_tags = $res->map(function($item,$key){
//            return ['post_id' => $item->id, 'tag_id' => $item->tag_id];
//        })->groupBy('tag_id');
//
//        $posts_tags->each(function($item,$key){
//            Redis::HSET('posts_tags',$key,json_encode($item->pluck('post_id')->all()));
//        });
    }
}
