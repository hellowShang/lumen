<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Redis;

class CheckTokenMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $token = $_GET['token'];
        $id = $_GET['id'];
        $key = 'token_'.$id;
        $redis_token = base64_encode(Redis::get($key));
        if(empty($token) || empty($id)){
            die(json_encode(['errcode' => 40007,'msg' => '参数错误'],JSON_UNESCAPED_UNICODE));
        }
        if($token != $redis_token){
            die(json_encode(['errcode' => 40008,'msg' => 'token过期'],JSON_UNESCAPED_UNICODE));
        }
        return $next($request);
    }
}
