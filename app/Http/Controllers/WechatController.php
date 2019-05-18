<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
class WechatController extends Controller
{
    // 微信支付接口
    public function pay(){
        echo '微信支付';
    }
}