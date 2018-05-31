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


class RegisterController extends BaseApiController
{

    public function register(Request $request){

        //return 'serverRegister';die;
        $data = $request->input();

        $data = json_decode($data);

        return $data;

    }

}