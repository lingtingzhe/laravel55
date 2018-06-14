<?php
/**
 * Created by PhpStorm.
 * User: huolian
 * Date: 2018/6/14
 * Time: 上午11:20
 */
namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Eloquent;

class EloquentController extends Controller
{
    public function __construct()
    {
        $this->EloquentModel = new Eloquent();
    }

    public function index()
    {
        $result = $this->EloquentModel->index();
        dd($result);
    }


}