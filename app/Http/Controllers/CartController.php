<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
class CartController extends Controller
{
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
}