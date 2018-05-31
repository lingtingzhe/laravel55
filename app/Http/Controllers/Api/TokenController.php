<?php
/**
 * Created by PhpStorm.
 * User: huolian
 * Date: 2018/5/30
 * Time: 下午5:11
 */
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseApiController;


class TokenController extends BaseApiController
{
    protected $expireIn = 60;
    private $serverToken = 'serverToken';

    public function genToken()
    {
        $timeStamp = time();
        $randomStr = $this->createNonceStr();
        $md5Info = $this->arithmetic($timeStamp,$randomStr);

        $data = [
            'code' => 200,
            'msg' => 'apiToken',
            'data' => [
                'timeStamp' => $timeStamp,
                'randomNum' => $randomStr,
                'md5Info' => $md5Info,
            ]
        ];

        $this->Redis->set($this->serverToken,$data['data']['md5Info']);
       // $this->date = $this->Redis->get($date);

        $data = response()->json($data);
        return $data;
    }

    /*
     * 验证token
     */
    public function Verification($token){

        if(empty($token) || !isset($token)){
            return response()->json($this->resultJsonStatus());
        }

        if($token != $this->Redis->get($this->serverToken)){
            return response()->json($this->resultJsonStatus(0,'fail'));
        }

        return 'successful';

    }

}