<?php
/**
 * Created by PhpStorm.
 * User: huolian
 * Date: 2018/5/25
 * Time: 下午4:56
 */
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function __construct()
    {
    }

    //主页 信息展示
    public function index(){
        //数据查询
        return 'data show';
    }
}