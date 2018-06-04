<?php
/**
 * Created by PhpStorm.
 * User: huolian
 * Date: 2018/5/28
 * Time: 上午10:51
 */
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseApiController;
use App\Http\Controllers\Api\TokenController;
use App\Models\RegisterModel;

class RegisterController extends BaseApiController
{

    public function __construct($user = null)
    {
        //parent::__construct($user);
        $this->RegisterModel = new RegisterModel();
    }

    public function register(Request $request){

        $Info['clientToken'] = $request->input('clientToken');
        $Info['username'] = $request->input('username');
        $Info['password'] = $request->input('password');
        $Info['email'] = $request->input('email');
        $this->TokenController = new TokenController();
        $verification = $this->TokenController->Verification($Info['clientToken']);

        if($verification != 'successful'){
            return $this->resultJsonStatus(0,'register_请求异常');
        }

        $result =  $this->RegisterModel->saveInfo($Info);

        return response()->json($this->resultJsonStatus(200,'successful',$result));

    }



}