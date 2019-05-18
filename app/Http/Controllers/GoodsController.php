<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
class GoodsController extends Controller
{
    // 获取商品数据接口
    public function getGoodsInfo(){
        $url = env('HTTP_PATH').'/goodsInfo';
        $response = curlGet($url);
        echo $response;
    }

    // 获取单个商品数据接口
    public function getGoodsDetail(){
        $id = $_GET['goods_id'];
        $url = env('HTTP_PATH').'/goodsDetail';
        $response = curlGet($url,['id' => $id]);
        echo $response;
    }
}