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
    private $TokenName = 'token';

    public function genToken()
    {
        $timeStamp = time();
        $randomStr = $this->createNonceStr();
        $md5Info = $this->arithmetic($timeStamp,$randomStr);

        $data = [
            'timeStamp' => $timeStamp,
            'randomNum' => $randomStr,
            'md5Info' => $md5Info,
        ];
        $date = $this->TokenName.'_'.date('Y-m-d-H-i-s',$data['timeStamp']);
        $this->Redis->set($date,$data['md5Info'],$this->expireIn);
        $this->date = $this->Redis->get($date);

        $data = response()->json($data);
        dd($data);
    }

    /*
     * 验证token
     */
    public function Valition()
    {
        
    }

}