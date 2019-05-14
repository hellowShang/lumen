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
$router->post('/user/decrypt','UserController@decrypt');

// 非对称解密
$router->post('/user/dec','UserController@keyDecrypt');

// 验证签名
$router->post('/user/sign','UserController@checkSign');

// 测试
//注册
$router->post('/reg','TestController@register');

// 登录
$router->post('/login','TestController@login');

// redis 测试
$router->get('/test','TestController@test');