<?php
/**
 * Created by PhpStorm.
 * User: huolian
 * Date: 2018/5/28
 * Time: 上午11:13
 */

namespace App\Http\Controllers\Api;


use Request;
use App\Http\Controllers\Api\BaseApiController;


class ClienterController extends BaseApiController
{
    protected $user;
    private $clientToken = 'clientToken';


    public function __construct($user = null)
    {

        parent::__construct($user);
        $this->user = $this->UserIsLogin();
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

        $result = laravelCurl($url);
        //打印返回数据
        dd($result);
    }

    /*
     * 请求token 接口
     */
    public function token(){

        $url = $this->URL.'/token';
        $data = laravelCurl($url,null,1,1);

        if(!empty($data['data'])){
            /*
             * 此处客户端，应使用 session 存储
             */
            $this->Redis->set($this->clientToken,$data['data']['md5Info']);
            return $data;
        }else{
           $this->token();
        }

    }

    /*
     * 模拟请求 后端首页数据
     */
    public function index(){

        /*
         * 此处token 应在session 取出
         */
        $url = $this->URL.'/serverIndex?token='.$this->Redis->get($this->clientToken);

        $indexInfo = laravelCurl($url);
        dd($indexInfo);
    }

    public function register(){

        $data = [
            'clientToken' => $this->Redis->get($this->clientToken),
            'id' => '1',
            'username' => 'huolian',
            'password' => encrypt('123456'),
            'alias' => '战神',
        ];

        $url = $this->URL.'/register';
        $registerInfo = laravelCurl($url,$data);
        dd($registerInfo);
    }




}