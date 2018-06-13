<?php
/**
 * Created by PhpStorm.
 * User: fsj
 * Date: 2018/5/4 0004
 * Time: 下午 01:54
 */

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Test;

class TestController extends Controller
{

    public function __construct()
    {
        $this->TestModel = new Test();
    }

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

    public function softDelete()
    {
       $result = $this->TestModel->DeleteData();
       dd($result);
    }
    public function self()
    {
        $result = $this->TestModel->self();
        dd($result);
    }
    public function getListData()
    {
        $result = $this->TestModel->getDataList();
        dd($result);
    }

    public function reject()
    {
        $result = $this->TestModel->reject();
        dd($result);
    }

    public function chunk()
    {
        $result = $this->TestModel->chunks();
        dd($result);
    }

    public function findOrFail()
    {
        $result = $this->TestModel->findOrFails();
        dd($result);
    }

    public function countAndmax()
    {
        $result = $this->TestModel->countAndmaxs();
        dd($result);
    }

    public function createds()
    {
        $result = $this->TestModel->createds();
        dd($result);
    }

    public function del()
    {
        $result = $this->TestModel->del();
        dd($result);
    }

    public function destroys()
    {
        $result = $this->TestModel->destroys();
        dd($result);
    }

    public function trashedsWith()
    {
        $result = $this->TestModel->trashedsWith();
        dd($result);
    }

    public function restores()
    {
        $result = $this->TestModel->restores();
        dd($result);
    }



}