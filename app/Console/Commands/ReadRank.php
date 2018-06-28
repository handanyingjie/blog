<?php

namespace App\Console\Commands;

use App\Models\Post;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class ReadRank extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'zadd:read-rank';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    private $redis;
    private $model;
    private $key = 'readRank';

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
        if($this->exists()) $this->clear();
        $this->generate();
    }

    private function clear(){
        $this->redis->del($this->key);
    }

    private function exists(){
        return $this->redis->EXISTS($this->key);
    }

    private function generate(){
        $this->model->published()
            ->limit(1000)
            ->get(['id','created_at'])
            ->each(function ($item){
                $key = "post:$item->id";
                $res = $this->redis->ZADD($this->key, $this->redis->HGET($key,'looks') ?: 0, $key);
                $this->info($res);
            });
    }
}
