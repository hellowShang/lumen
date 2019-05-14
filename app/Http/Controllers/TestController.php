<?php
/**
 * Created by PhpStorm.
 * User: Hello 摩托
 * Date: 2019/5/13
 * Time: 9:08
 */

namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redis;

class TestController extends Controller
{
    // 注册
    public function register(){
        $data = file_get_contents('php://input');

        $key = openssl_get_publickey('file://'.storage_path('app/keys/public.pem'));
        openssl_public_decrypt(base64_decode($data),$decrypt,$key);
        $form_data = json_decode($decrypt,true);
        $id = DB::table('userinfo')->insertGetId($form_data);
//        $id = 0;
        if($id){
            $json = [
                'errcode'   => 0,
                'msg'       => '注册成功'
            ];
            die(json_encode($json,JSON_UNESCAPED_UNICODE));
        }else{
            $json = [
                'errcode'   => 40001,
                'msg'       => '注册失败'
            ];
            die(json_encode($json,JSON_UNESCAPED_UNICODE));
        }
    }

    // redis测试
    public function test(){
        header('Access-Control-Allow-Origin:*');

        $id = $_GET['id'];
        $data = DB::table('userinfo')->where(['id' => $id])->first();
        $json = json_encode($data);
        echo $json;
//        $k = '123';
//        $v = '123123123';
//        Redis::set($k,$v);
//        echo Redis::get($k);
    }

    // 登录
    public function login(){
        $b64_data = file_get_contents('php://input');
        $key = openssl_get_publickey('file://'.storage_path('app/keys/public.pem'));
        openssl_public_decrypt(base64_decode($b64_data),$decrypt,$key);
        $data = json_decode($decrypt,true);
        $arr = DB::table('userinfo')->where(['email' => $data['email']])->first();
        $arr = json_decode(json_encode($arr),true);
        if($arr){
            if(password_verify($data['pass'],$arr['pass1'])){
                // 生成token
                $token = substr(md5(time().$arr['id'].Str::random(10).rand(111,999)),5,20);
                $json = [
                    'errcode'   => 0,
                    'msg'       => '登录成功',
                    'token'     => base64_encode($token)
                ];
                die(json_encode($json,JSON_UNESCAPED_UNICODE));
            }else{
                $json = [
                    'errcode'   => 40002,
                    'msg'       => '密码错误',
                ];
                die(json_encode($json,JSON_UNESCAPED_UNICODE));
            }
        }else{$json = [
            'errcode'   => 40003,
            'msg'       => '账号错误',
        ];
            die(json_encode($json,JSON_UNESCAPED_UNICODE));
        }
    }
}