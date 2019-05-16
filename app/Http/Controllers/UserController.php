<?php
/**
 * Created by PhpStorm.
 * User: Hello 摩托
 * Date: 2019/5/8
 * Time: 17:04
 */

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redis;

class UserController  extends Controller
{


    // 注册
    public function register(Request $request){
        $data = $_POST;
        $str = json_encode($data);
        $url = "http://passport.lab993.com/user/register";
        $response = curl($url,$str);
        echo $response;
    }

    // 登录
    public function login(){
        $data = $_POST;
        $str = json_encode($data);
        $url = "http://passport.lab993.com/user/login";
        $response = curl($url,$str);
        echo $response;
    }

    // 获取用户信息
    public function getUserInfo(){
        $id = $_GET['id'];
        $userInfo = DB::table('userinfo')->where(['id' => $id])->first();
        if($userInfo){
            $data = json_decode(json_encode($userInfo),true);
            die(json_encode(['errcode' => 0,'data' => $data],JSON_UNESCAPED_UNICODE));
        }else{
            die(json_encode(['errcode' => 50000,'msg' => '数据不存在'],JSON_UNESCAPED_UNICODE));
        }
    }
}