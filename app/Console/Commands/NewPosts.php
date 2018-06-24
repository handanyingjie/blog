<?php

namespace App\Console\Commands;

use App\Models\Post;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class NewPosts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lpush:new-post';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'posts list | max length 1000';

    private $redis;
    private $model;
    private $key = 'newPosts';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Post $post)
    {
        $this->model = $post;
        $this->redis = Redis::connection('default');
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if($this->existsNewPosts()) $this->clearNewPosts();

        $this->generateNewPosts();
    }

    private function clearNewPosts(){
        $this->redis->del($this->key);
    }

    private function existsNewPosts(){
        return $this->redis->EXISTS($this->key);
    }

    private function generateNewPosts(){
        $this->model->published()
            ->orderBy('created_at','asc')
            ->limit(1000)
            ->get(['id','created_at'])
            ->each(function ($item){
                $this->info($this->redis->LPUSH($this->key,"post:$item->id"));
            });
    }
}
