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
    protected $expireIn = 7200;
    private $serverToken = 'serverToken';
    private $LoginToken = 'clientLoginToken';

    /*
     * 0 未登陆
     * 1 登陆
     */
    public function genToken($result = [] , $user = 0)
    {

        $timeStamp = time();
        $randomStr = $this->createNonceStr();
        $md5Info = $this->arithmetic($timeStamp,$randomStr);

        if(!$user){

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

        }else{

            $data = [
                'code' => 200,
                'msg' => 'clientLoginToken', //$this->LoginToken,
                'data' => [
                    'id' => $result['id'],
                    'username' => $result['name'],
                    'email' => $result['email'],
                    'md5Info' => $md5Info,
                    'expireIn' => $this->expireIn,
                ]
            ];

            $index = 'clientLoginToken_'.$result['id'];
            $this->Redis->set($index,$data['data']['md5Info'],$this->expireIn);
            $this->Redis->set('clientLoginId',$data['data']['id'],$this->expireIn);

        }

        $data = response()->json($data);
        return $data;
    }

    /*
     * 验证token
     */
    public function Verification($token,$loginToken = []){

        if(empty($token) || !isset($token)){
            return response()->json($this->resultJsonStatus());
        }

        if($token != $this->Redis->get($this->serverToken)){
            return response()->json($this->resultJsonStatus(0,'token check fail'));
        }

        if(!isset($loginToken) && $this->Redis->get('clientLoginToken') != $loginToken || $loginToken == null){
            return response()->json($this->resultJsonStatus(0,'clientLoginToken check fail'));
        }else{
//            $this->Redis->set('clientLoginToken_'.$this->Redis->get('clientLoginId'),$this->genToken(),$this->expireIn);
//            $this->Redis->set($this->Redis->get('clientLoginId'),$this->expireIn);
            return redirect('/login');
        }

        return 'successful';

    }

}