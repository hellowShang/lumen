<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
class OrderController extends Controller
{
    // 订单生成
    public function orderGenerate(){
        $goods_id = $_GET['goods_id'];
        $pay_way = $_GET['pay_way'];
        $uid = $_GET['id'];
        $url = env('HTTP_PATH').'/user/orderGenerate';
        $response = curlGet($url,['goods_id' => $goods_id,'uid' => $uid,'pay_way' => $pay_way]);
        echo $response;
    }
}