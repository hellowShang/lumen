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
            die('注册成功');
        }else{
            die('注册失败');
        }
    }
}