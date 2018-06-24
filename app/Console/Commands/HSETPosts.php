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
        $this->model->published()
            ->limit(1000)
            ->get()
            ->except(['updated_at'])
            ->map(function($post){
                $this->info($this->redis->HMSET("post:$post->id",$post->toArray()));
            });
    }
}
