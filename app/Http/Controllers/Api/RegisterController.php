<?php
/**
 * Created by PhpStorm.
 * User: huolian
 * Date: 2018/5/28
 * Time: 上午10:51
 */
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseApiController;
use Illuminate\Support\Facades\Input;
use Request;

class RegisterController extends BaseApiController
{
    const TOKEN = 'API';

    public function register(Request $request){

        //响应前台的请求
        //验证身份
        //return $_SERVER;die;

        $timeStamp = Input::get('t') ? Input::get('t') : '1';
        $randomStr = Input::get('r') ? Input::get('r') : '2';
        $signature = Input::get('s') ? Input::get('s') : '3';
        $str = $this->arithmetic($timeStamp,$randomStr);

        if($str != $signature){
            echo "-3333";
            exit;
        }

        //模拟数据
        $arr['name'] = 'api';
        $arr['age'] = 15;
        $arr['address'] = 'zz';
        $arr['ip'] = "192.168.0.1";
        echo json_encode($arr);

    }





}