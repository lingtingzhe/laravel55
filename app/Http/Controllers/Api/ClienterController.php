<?php
/**
 * Created by PhpStorm.
 * User: huolian
 * Date: 2018/5/28
 * Time: 上午11:13
 */

namespace App\Http\Controllers\Api;

use Request;
use Illuminate\Support\Facades\Redis;
use App\Http\Controllers\Api\BaseApiController;


class ClienterController extends BaseApiController
{
    protected $user;

    public function __construct($user = null)
    {

        parent::__construct($user);
        //$this->user = $this->UserIsLogin();
    }

    /*
     *  模拟前台请求服务器api接口
     */
    public function getDataFromServer(Request $request){
        //时间戳
        $timeStamp = time();
        //随机数
        $randomStr = $this -> createNonceStr();
        //生成签名
        $signature = $this -> arithmetic($timeStamp,$randomStr);
        //echo $signature;
        //url地址
        $url = $this->URL."/register?t={$timeStamp}&r={$randomStr}&s={$signature}";
        dd($url);die;
        $result = laravelCurl($url);
        //打印返回数据
        dd($result);
    }

    public function redis(Request $request){
        $data = [
            'user1' => [
                'id' => '1',
                'name' => 'zhangsan',
                'sex' => '0',
                'age' => '19'
            ],
//            'user2' => [
//                'name' => 'lisi',
//                'age' => '1',
//                'sex' => '20'
//            ]
        ];

        Redis::setFacadeApplication($data);
        $result= Redis::getFacadeApplication();

        foreach($result as $value){
            $result = $value;
        }
        //Session('name',$result['name']);
        $request->session()->set('name',$result['name']);
        //dd($result);

    }

    public function UserIsLogin(Request $request){
        $userInfo = $request->session()->get();
        dd($userInfo);die;
    }

}