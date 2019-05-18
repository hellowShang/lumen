<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
class OrderController extends Controller
{
    // 订单生成
    public function orderGenerate(){
        $goods_id = $_GET['goods_id'];
        $uid = $_GET['id'];
        $url = env('HTTP_PATH').'/orderGenerate';
        $response = curlGet($url,['goods_id' => $goods_id,'uid' => $uid]);
        echo $response;
    }
}