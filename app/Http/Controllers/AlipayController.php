<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
class AlipayController extends Controller
{
    // 支付宝支付接口
    public function pay(){
       $order_no = $_GET['order_no'];
       $uid = $_GET['id'];
       $url = env('HTTP_PATH').'/alipay';
       $response = curlGet($url,['order_no' => $order_no,'uid' => $uid]);
       echo $response;
    }
}