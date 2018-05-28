<?php
/**
 * Created by PhpStorm.
 * User: huolian
 * Date: 2018/5/28
 * Time: 上午10:55
 */

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Request;

class LoginController extends Controller
{
    public function login(Request $request){
        echo 'boys and girl';
        //var_dump($request->all());
    }
}