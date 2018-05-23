<?php
/**
 * Created by PhpStorm.
 * User: fsj
 * Date: 2018/5/4 0004
 * Time: 下午 01:54
 */

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;

class TestController extends Controller {

    public function index(){
        $name = 'fanzhiqiang';
        $age = '18';
        $sex = '男';
        $data = [
            'name' => $name,
            'age' => $age,
            'sex' => $sex
        ];
       return view("test/index",$data);
    }

    public function base(){
        return view("article/common/base");
    }

    public function config(){
        $name = config("redis.name");
        $host = config("redis.host");
        $port = config("redis.port");

        echo $name,$host,$port;
        echo "<hr >";
        print_r(config("redis.name"));
    }
    public function section(){
        return view("article/common/section");
    }




}