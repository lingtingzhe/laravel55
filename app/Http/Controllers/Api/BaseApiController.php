<?php
/**
 * Created by PhpStorm.
 * User: huolian
 * Date: 2018/5/28
 * Time: 下午5:00
 */
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class BaseApiController extends Controller
{
    const TOKEN = 'API';
    protected $Http = 'http';
    protected $URL = 'laravel55.com/api/api2';

    public function __construct($user = null)
    {
        /*
         * 此处判断 是否登陆
         * 登陆生成新的token， 供后期使用
         * 未登陆，则生成token 供接口调用
         *      生成方式，存放时间，参数异常
         */
        if($user){
            echo 'trues';
        }else{
            echo 'falses';
        }

    }

    /*
     *  请求需要的token值
     */
    public function genToken(){
        $time = time();
        $randomNum = $this->createNonceStr();
        $sign = $this->arithmetic($time,$randomNum);
        return $sign;

    }

    /*
     *  随机生成字符串
     */
    protected function createNonceStr($length = 8){
        $char = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $str = '';
        for($i = 0; $i< $length; $i++){
            $str.= substr($char,mt_rand(0,strlen($char)-1),1);
        }
        return 'z'.$str;
    }

    /**
     * @param $timeStamp 时间戳
     * @param $randomStr 随机字符串
     * @return string 返回签名
     */
    protected function arithmetic($timeStamp,$randomStr){
        $arr['timeStamp'] = $timeStamp;
        $arr['randomStr'] = $randomStr;
        $arr['token'] = self::TOKEN;
        ksort($arr);
        $str = implode($arr);
        $sha1 = sha1($str);
        $md5Data = md5($sha1);
        $signtrue = strtoupper($md5Data);
        return $signtrue;
    }

    /*
    　　sort() 函数用于对数组单元从低到高进行排序。
    　　rsort() 函数用于对数组单元从高到低进行排序。
    　　asort() 函数用于对数组单元从低到高进行排序并保持索引关系。
    　　arsort() 函数用于对数组单元从高到低进行排序并保持索引关系。
    　　ksort() 函数用于对数组单元按照键名从低到高进行排序。
    　　krsort() 函数用于对数组单元按照键名从高到低进行排序。
     */
    protected function sort(){
        $key = array("a", "d", "c");
        sort($key);
        echo 'sort '; print_r($key);
        echo '<br />';

        rsort($key);
        echo 'rsort ';print_r($key);
        echo '<br />';

        asort($key);
        echo 'asort ';print_r($key);
        echo '<br />';

        arsort($key);
        echo 'arsort ';print_r($key);
        echo '<br />';

        ksort($key);
        echo 'ksort ';print_r($key);
        echo '<br />';

        krsort($key);
        echo 'krsort ';print_r($key);

    }
}