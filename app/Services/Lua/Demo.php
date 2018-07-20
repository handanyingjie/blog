<?php

namespace App\Services\Lua;

use \Predis\Command\ScriptCommand;

class Demo extends ScriptCommand {
    public function getKeysCount(){
        return false;
    }

    public function getScript(){
        return <<<LUA
local tagId = ARGV[1]
local offset = ARGV[2]
local total = ARGV[3]
local idArr = {}
local posts = {}
local post = {}
local data = {}
local count = 0

if(tagId and tagId ~= '0') then
    redis.call('DEL','tmp:search')
    redis.call('SINTERSTORE','tmp:search','posts:list',tagId..':posts')
    idArr = redis.call('SORT','tmp:search','BY','*->published_at','LIMIT', offset, total, 'DESC', 'ALPHA')
    count = redis.call('SCARD','tmp:search')
else
    idArr = redis.call('SORT', 'posts:list','BY','*->published_at','LIMIT', offset, total, 'DESC', 'ALPHA')
    count = redis.call('SCARD','posts:list')
end

for k=1,#idArr do
    post = redis.call('HMGET',idArr[k], 'title','published_at')
    table.insert(post,idArr[k])
    posts[k] = post
end

data[1] = posts
data[2] = count
return data
LUA;
    }
}