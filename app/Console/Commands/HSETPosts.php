<?php

namespace App\Console\Commands;

use App\Models\Post;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class HSETPosts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hset:posts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Redis Database | key post:id | type hash';

    private $redis;
    private $key = 'posts';
    private $model;
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Post $post)
    {
        $this->redis = Redis::connection('default');
        $this->model = $post;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if($this->existsPosts()) $this->clearPosts();
        $this->generatePosts();
    }

    private function clearPosts(){
        $this->redis->del($this->key);
    }

    private function existsPosts(){
        return $this->redis->EXISTS($this->key);
    }

    private function generatePosts(){
        $posts = $this->model
            ->limit(1000)
            ->latest()
            ->get();
        $posts->except(['updated_at'])
            ->map(function($post,$index) use($posts){
                if(count($posts) == 1){
                    $prev = $next =  $posts->id;
                } elseif(0 === $index && isset($posts[1])){
                    $prev = $posts[$index]->id;
                    $next = $posts[1]->id;
                } elseif($index > 0 && isset($posts[$index + 1])) {
                    $prev = $posts[$index - 1]->id;
                    $next = $posts[$index + 1]->id;
                } elseif($index == count($posts) - 1){
                    $prev = $posts[$index - 1]->id;
                    $next = $posts[$index]->id;
                }

                $prev = "post:$prev";
                $next = "post:$next";
                $this->info($prev);
                $this->info($next);
                $this->info($this->redis->HMSET("post:$post->id",collect($post)->merge(['prev' => $prev,'next' => $next])->toArray()));
            });
    }
}
