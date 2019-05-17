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

    // 获取商品数据接口
    public function getGoodsInfo(){
        $url = env('HTTP_PATH').'/user/goodsInfo';
        $response = curlGet($url);
        echo $response;
    }

    // 获取单个商品数据接口
    public function getGoodsDetail(){
        $id = $_GET['goods_id'];
        $url = env('HTTP_PATH').'/user/goodsDetail';
        $response = curlGet($url,['id' => $id]);
        echo $response;
    }

    // 加入购物车接口
    public function joinCart(){
        $goods_id = $_GET['goods_id'];
        $id = $_GET['id'];

        // 获取单个商品并添加当前用户id
        $url = env('HTTP_PATH').'/user/goodsDetail';
        $response = curlGet($url,['id' => $goods_id]);
        $data = json_decode($response);
        $data->user_id = $id;
        $json_str = json_encode($data,JSON_UNESCAPED_UNICODE);

        // 加入购物车
        $urll = env('HTTP_PATH').'/user/joinCart';
        $response1 = curl($urll,$json_str);
        echo $response1;
    }

    // 购物车数据展示接口
    public function cartList(){
        $id = $_GET['id'];
        $url = env('HTTP_PATH').'/user/cartInfo';
        $response = curlGet($url,['uid' => $id]);
        echo $response;
    }

    // 订单生成
    public function orderGenerate(){
        $goods_id = $_GET['goods_id'];
        $uid = $_GET['id'];
        $url = env('HTTP_PATH').'/user/orderGenerate';
        $response = curlGet($url,['goods_id' => $goods_id,'uid' => $uid]);
        echo $response;
    }
}