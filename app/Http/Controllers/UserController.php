<?php
/**
 * Created by PhpStorm.
 * User: Hello 摩托
 * Date: 2019/5/8
 * Time: 17:04
 */

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redis;

class UserController  extends Controller
{
    // 错误
    public function error($num,$msg){
        $json = [
            'errcode'       =>  $num,
            'msg'           =>  $msg
        ];
        die(json_encode($json,JSON_UNESCAPED_UNICODE));
    }

    // 正确
    public function success($num,$msg,$data){
        $json = [
            'errcode'       =>  $num,
            'msg'           =>  $msg,
            'data'          =>  $data
        ];
        die(json_encode($json,JSON_UNESCAPED_UNICODE));
    }

    // 注册
    public function register(Request $request){
//        header('Access-Control-Allow-Origin:http://127.0.0.1:8848');
        $data = $_POST;
        // 验非空
        if($data['pass1'] != $data['pass2']){
            $this->error(40001,'两次密码输入不一致');
        }
        // 验唯一
        $res = DB::table('userinfo')->where(['email' => $data['email']])->first();
        if($res){
            $this->error(40002,'该邮箱已经注册过了');
        }
        // 数据处理
        unset($data['pass2']);
        $data['pass1'] = password_hash($data['pass1'],PASSWORD_BCRYPT);
        $id = DB::table('userinfo')->insertGetId($data);
        // 判断提示
        if($id){
            $this->error(0,'注册成功');
        }else{
            $this->error(40005,'注册失败');
        }
    }

    // 登录
    public function login(){
//        header('Access-Control-Allow-Origin:http://127.0.0.1:8848');
//        header('Access-Control-Allow-Method:OPTIONS POST GET DELETE');
//        header('Access-Control-Allow-Headers:x-requested-with content-type');
        $data = $_POST;
//        var_dump($data);die;
        // 验非空
        if(empty($data['email'])){
            $this-> error(40003,'邮箱账号不能为空');
        }
        if(empty($data['pass'])){
            $this-> error(40003,'密码不能为空');
        }
        // 验证账号、密码
        $arr = DB::table('userinfo')->where(['email' => $data['email']])->first();
        $arr = json_decode(json_encode($arr),true);
        if($arr){
            if(password_verify($data['pass'],$arr['pass1'])){
                // 生成token
                $key = 'token_'.$_SERVER['REMOTE_ADDR'].'_'.$arr['id'];
                $token = Redis::get($key);
                if($token){
                }else{
                    $token = substr(md5(time().$arr['id'].Str::random(10).rand(111,999)),5,20);
                    Redis::set($key,$token);
                    Redis::expire($key,7200);
                }
                $this->success(0,'登录成功',['token' => base64_encode($token),'id' => $arr['id']]);
            }else{
               $this->error(40005,'密码错误');
            }
        }else{
            $this->error(40005,'账号错误');
        }
    }
}