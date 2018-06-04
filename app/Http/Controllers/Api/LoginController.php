<?php
/**
 * Created by PhpStorm.
 * User: huolian
 * Date: 2018/5/28
 * Time: 上午10:55
 */

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\TokenController;
use App\Models\LoginModel;
use App\Http\Controllers\Api\BaseApiController;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->TokenController = new TokenController();
        $this->LoginModel = new LoginModel();
        $this->BaseApiController = new BaseApiController();

    }

    public function login(Request $request){

        $info = $request->input();

        $verificationToken = $this->TokenController->Verification($info['clientToken']);
        if($verificationToken != 'successful'){
            return $this->BaseApiController->resultJsonStatus(0,'register_请求异常');
        }

        $result =  $this->LoginModel->login($info);

        if($result['status'] != 'successful'){
            $this->BaseApiController->resultJsonStatus(0,'Login--网络异常');
        }
        /*
         * 重新生成token 过期时间，存储方式，生成方法
         */

        $result = $this->TokenController->genToken($result,1);


        return $result;
    }
}