<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

// 对称加密
$router->post('/user/decrypt','RyptController@decrypt');

// 非对称解密
$router->post('/user/dec','RyptController@keyDecrypt');

// 验证签名
$router->post('/user/sign','RyptController@checkSign');

// 测试
//注册
$router->post('/reg','TestController@register');

// 登录
$router->post('/login','TestController@login');

// redis 测试
$router->get('/test','TestController@test');

// 用户
// 注册
$router->post('/user/register','UserController@register');
// 登录
$router->post('/user/login','UserController@login');

// 验证token
$router->group(['middleware' => 'token'],function() use ($router){
    // 个人中心
    $router->get('/user/userinfo','UserController@getUserInfo');

    // 获取商品信息
    $router->get('/goodsinfo','UserController@getGoodsInfo');
});