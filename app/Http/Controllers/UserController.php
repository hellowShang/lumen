<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;

class UserController  extends Controller
{
    // 注册接口
    public function register(Request $request){
        $data = $_POST;
        $str = json_encode($data);
        $url = env('HTTP_PATH')."/user/register";
        $response = curl($url,$str);
        echo $response;
    }

    // 登录接口
    public function login(){
        $data = $_POST;
        $str = json_encode($data);
        $url = env('HTTP_PATH')."/user/login";
        $response = curl($url,$str);
        echo $response;
    }

    // 获取用户信息接口
    public function getUserInfo(){
        $id = $_GET['id'];
        $url = env('HTTP_PATH').'/user/userInfo';
        $response = curlGet($url,['id' => $id]);
        echo $response;
    }
}