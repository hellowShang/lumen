<?php
/**
 * Created by PhpStorm.
 * User: Hello 摩托
 * Date: 2019/5/8
 * Time: 17:04
 */

namespace App\Http\Controllers;


class UserController
{
    // 对称解密
    public function decrypt(){
        // 接收数据
        $data = file_get_contents('php://input');
        // key
        $key = 'CBCENCRYPT';
        // 密码学方式 使用AES-128-CBC加密算法
        $method = 'AES-128-CBC';
        // OPENSSL_RAW_DATA 或 OPENSSL_ZERO_PADDING 加密解密须一致
        $options = OPENSSL_RAW_DATA;
        // 非空的初始化向量 16位
        $iv = 'abcdefghijklmnop';
        // 解密数据
        echo openssl_decrypt(base64_decode($data),$method,$key,$options,$iv);
    }

    // 非对称解密
    public function keyDecrypt(){
        // 接收值
        $str = base64_decode(file_get_contents('php://input'));

        // 获取公钥
        $public_keys = openssl_get_publickey('file://'.storage_path('app/keys/public.pem'));

        // 用公钥钥解密数据
        openssl_public_decrypt($str,$decrypt_str,$public_keys);

        echo $decrypt_str;
    }

    // 验证签名
    public function checksign(){

    }
}