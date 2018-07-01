<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redis;
use App\Http\Requests\Home\RegisterRequest;
use App\Http\Requests\Home\CodeRequest;
use App\Jobs\SendEmail;
use App\Mail\RegisterLink;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home.index');
    }

    public function test(Request $request){
//        $res = encrypt(1);
        $res = decrypt('eyJpdiI6IlFUTVZoaXJDREtOWnZ1TmxmdURKOHc9PSIsInZhbHVlI');
        dd($res);
    }

    public function register(RegisterRequest $request){
        if(Redis::HEXISTS('email.to.id',$request->email)){
            return response()->json(['status' => 500, 'message' => '邮箱已存在!']);
        }

        //临时存储,有效期为24小时，如果24小时未激活自动清除
        $data = $request->except(['_token','password_confirmation','_url']);
        $data['password'] =  bcrypt($request->password);

        $id = Redis::INCR('temp.users:count');
        Redis::WATCH('temp.users:count');

        Redis::MULTI();
        Redis::HMSET("temp.user:$id", $data);
        Redis::EXPIRE("temp.user:$id",60 * 60 * 24);
        Redis::EXEC();

        Mail::to($data['email'])
            ->queue(new RegisterLink(['link' => route('active',['id' => encrypt($id)])]));
        return response()->json(['status' => 200, 'message' => '邮件已发送!请于24小时之内激活!']);
    }

    public function login(){
        return 'login';
    }

    public function active($id){
        try {
            $id = decrypt($id);
        }catch (\Exception $e){
            return view('mail.fail',['link' => route('home_index')]);
        }

        $key = "temp.user:$id";
        if(!Redis::TTL($key)) {
            return view('mail.fail',['link' => route('home_index')]);
        }

        $len = Redis::HLEN($key);
        $data = Redis::HSCAN($key,0,['count' => $len]);

        $userId = Redis::INCR('users:count');
        Redis::WATCH('users:count');

        $data = array_pop($data);
        Redis::MULTI();
        Redis::HMSET("user:$userId",$data);
        Redis::HSET("email.to.id",$data['email'],$userId);
        Redis::DEL($key);
        Redis::EXEC();

        return view('mail.success',['link' => route('home_index')]);
    }
}
