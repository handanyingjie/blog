<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class Test extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:test';

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
        $beginTime = microtime(true);
        Redis::SELECT(1);
//        for($i =0; $i < 2000000; $i ++){
//            Redis::HSET('test',"key$i",$i);
//        }
//        die;
        $it = 0;
        do {
            $res = Redis::HSCAN('test',$it,['count' => 50]);
            $it = $res[0];
            $this->info($it);
            if(is_array($res[1])){
                foreach($res[1] as $val){
                    echo $val."\n";
                }
            }
        } while($it > 0);

        $endTime = microtime(true);
        $this->info($endTime - $beginTime);
        die;
        $beginTime = microtime(true);
//        $it = 0;
        Redis::SELECT(1);
//        do{
           $res = Redis::HGETALL('test');
           foreach($res as $val){
               echo $val."\n";
           }
//        }while($it > 0);
        $endTime = microtime(true);
        $this->info($endTime - $beginTime);
    }
}
