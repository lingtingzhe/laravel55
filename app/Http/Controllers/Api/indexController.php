<?php
/**
 * Created by PhpStorm.
 * User: huolian
 * Date: 2018/5/31
 * Time: 上午10:40
 */
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseApiController;
use App\Http\Controllers\Api\TokenController;
use Mockery\Exception;

class indexController extends BaseApiController
{
    public function __construct($user = null)
    {
        //parent::__construct($user);
        $this->TokenController = new TokenController();
    }

    //后端 查询首页数据
    public function index(Request $request){


        $tokenInfo = $request->input('token');

        $verificationMsg = $this->TokenController->Verification($tokenInfo);
        if($verificationMsg != 'successful'){
            //throw new Exception('请求异常');
            return $this->apiTokenVerification('请求异常');
        }

        $data = [
            [
                'name' => 'zhangsan',
                'age' => '18',
                'phone' => '15113754378'
            ],
            [
                'name' => 'lisi',
                'age' => '18',
                'phone' => '15113754378'
            ],
            [
                'name' => 'lisi',
                'age' => '18',
                'phone' => '15113754378'
            ]
        ];
        //return $data;

        return response()->json($data);

    }
}