<?php
/**
 * curl 数据发送
 * @param $url
 * @param $data
 * @return bool|string
 */
function  curl($url,$data){
    // 1. 初始化
    $ch = curl_init();

    // 2. 设置选项参数
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_POST,1);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
    curl_setopt($ch,CURLOPT_HTTPHEADER,['Content-type:text/plain']);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
    // 3. 获取并抛出错误
    $num = curl_errno($ch);
    if($num>0){
        echo 'cURL错误码：'.$num;exit;
    }

    // 4. 发起请求
    $str = curl_exec($ch);
    return $str;
    // 5. 关闭并释放资源
    curl_close($ch);
}

//function curlGet($url,$data){
//    // 1. 拼接url
//    $str = '?';
//    foreach($data as $k=> $v){
//        $str .=  $k . '=' . $v . '&';
//    }
//    $str = rtirm($str,'&');
//    $url = $url . $str;
//
//    // 2. 初始化
//    $ch = curl_init();
//
//    curl_setopt($ch,CURLOPT_URL,$url);
//}