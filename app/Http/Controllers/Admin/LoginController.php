<?php
/**
 * Created by PhpStorm.
 * User: fsj
 * Date: 2018/5/8 0008
 * Time: 下午 05:00
 */
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller {

    use AuthenticatesUsers;

    protected $redirectTo = './admin';

    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    /*
     * 重写登录页面
     */
    public function showLoginForm()
    {
        return view('admin/login');
    }

    /*
     * 重写退出方法
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();
        $request->session()->flush();
        $request->session()->regenerate();
        return redirect('/admin/login');
    }

    /*
     * 重写guard认证
     */
    public function guard()
    {
        //return Auth::guard('admin');
        return Auth::guard('admin');
    }



}