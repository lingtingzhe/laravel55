<?php
/**
 * Created by PhpStorm.
 * User: fsj
 * Date: 2018/5/8 0008
 * Time: 下午 04:52
 */
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Authenticatable;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;

class AdminController extends Controller{
    use Authenticatable,DispatchesJobs,ValidatesRequests;

    public function __construct()
    {
        //$this->middleware('auth:admin');
    }

    public function index()
    {
        if(!empty(auth('admin'))) {
            return view('admin/login');
        }else{
            return view('admin/login');
        }
    }

}