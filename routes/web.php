<?php

use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();

/*
 * 后台
 */
Route::group(['prefix'=>'admin','namespace'=>'Admin'],function(){
    //后台首页
    Route::get('/', 'AdminController@index');

});

/*
 * 前台
 */
Route::group(['prefix'=>'/','namespace'=>'Home','middleware'=>['web']],function(){

    Route::get('/','HomeController@index');
    //Route::get('/testInsert','HomeController@testInsert');
    Route::get('/testInsert',function(){
    	return view('home/testInsert');
    });

    Route::post('/addData','HomeController@addData');
    Route::get('/deleteInfo/{id}','HomeController@deleteInfo');

    //加密
    Route::get('/storeSecret','EncryptController@storeSecret');
    Route::get('/encryptString','EncryptController@encryptString');

    Route::get('/encrypt',function(){
        $data = encrypt('hello world');
        $decryptInfo = decrypt($data);
        dd(['afterData'=>$data,'jiemi'=>$decryptInfo]);
    });
    Route::get('/xulihua',function(){
        $data =  encrypt(serialize('bufuqing'));
        echo $data;
        echo '<br />';
        echo unserialize(decrypt($data));
    });

    Route::get('session',function(Request $request){
        $request['username'] = 'admins@laravel.com';
        $request['password'] = '111111';
        $data = $request->session()->regenerate();
        dd($data);die;
    });

    /*  下面代码测试使用 暂时不需要 */
    Route::get("/base/","TestController@base");
    Route::get("/config","TestController@config");
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get("/section","TestController@section");
    /* 路由重定向 */
    Route::redirect('/home','three');
    Route::get('/dataInfo','HomeController@dataInfo');

    Route::post('/register','Auth\RegisterController@register');
});
//
//Route::middleware(['first','second'])->group(function(){
//    Route::get('/',function(){
//        /* 使用 first 和 secoond 中间件 */
//    });
//    Route::get('/user/profile',function(){
//        /* 使用 first 和 secoond 中间件 */
//    });
//});
/* 定义子域名 跳转 */
Route::domain('{account}.myapp.com')->group(function(){
    Route::get('user/{id}',function($account ,$id){
        /*  */
    });
});



//定义： API接口验证跳转
Route::get('/auth/callback',function(Request $request){
    if($request->get('code')){
        return 'Login Success';
    }else{
        return 'Access Denied';
    }
});

Route::get('vue',function(){
    return view('vue');
});