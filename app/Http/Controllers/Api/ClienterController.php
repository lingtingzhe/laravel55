<?php
/**
 * Created by PhpStorm.
 * User: huolian
 * Date: 2018/5/28
 * Time: 上午11:13
 */

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Request;
//use function laravelCurl;

class ClienterController extends Controller
{
    const TOKEN = 'API';
    const HeaderHTTP = 'http';
    const URL = 'laravel55.com/api/api2';
    //模拟前台请求服务器api接口

    public function getDataFromServer(Request $request){
        //时间戳
        $timeStamp = time();
        //随机数
        $randomStr = $this -> createNonceStr();
        //生成签名
        $signature = $this -> arithmetic($timeStamp,$randomStr);
        echo $signature;
        //url地址
        $url = self::URL."/register?t={$timeStamp}&r={$randomStr}&s={$signature}";
        $result = laravelCurl($url);
        //打印返回数据
        dd($result);
    }

    //随机生成字符串
    private function createNonceStr($length = 8){
        $char = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $str = '';
        for($i = 0; $i< $length; $i++){
            $str.= substr($char,mt_rand(0,strlen($char)-1),1);
        }
        return 'z'.$str;
    }


//       @param $timeStamp 时间戳
//       @param $randomStr 随机字符串
//       @return string 返回签名

    private function arithmetic($timeStamp,$randomStr){
        $arr['timeStamp'] = $timeStamp;
        $arr['randomStr'] = $randomStr;
        $arr['token'] = self::TOKEN;
        ksort($arr);
        print_r($arr);
        $str = implode($arr);
        $sha1 = sha1($str);
        $md5Data = md5($sha1);
        $signtrue = strtoupper($md5Data);
        return $signtrue;
    }


}