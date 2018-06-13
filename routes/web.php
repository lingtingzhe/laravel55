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

    /*
     * 软删除 学习
     */
    Route::get('softdelete','TestController@softDelete');
    Route::get('self','TestController@self');
    Route::get('list','TestController@getListData');
    Route::get('reject','TestController@reject');
    Route::get('chunk','TestController@chunk');
    Route::get('findOrFail','TestController@findOrFail');
    Route::get('countAndmax','TestController@countAndmax');
    Route::get('createds','TestController@createds');
    Route::get('del','TestController@del');
    Route::get('destroy','TestController@destroys');
    Route::get('withTrashed','TestController@trashedsWith');
    Route::get('restores','TestController@restores');

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
//    if($request->get('code')){
//        return 'Login Success';
//    }else{
//        return 'Access Denied';
//    }

    $http = new GuzzleHttp\Client();

    $response = $http->post('http://laravel55.com/oauth/token', [
        'form_params' => [
            'grant_type' => 'authorization_code',
            'client_id' => '4',  // your client id
            'client_secret' => 'pWTIcgNEe2eo3UlC3wTSHjQSuHjh3dMIHadi56XJ',   // your client secret
            'redirect_uri' => 'http://laravel55.com/auth/callback',
            'code' => $request->code,
        ],
    ]);

    return json_decode((string) $response->getBody(),true);


});

Route::get('/auth/password', function (Request $request){

    $http = new \GuzzleHttp\Client();

    $response = $http->post('http://laravel55.com/oauth/token', [
        'form_params' => [
            'grant_type' => 'password',
            'client_id' => '7',
            'client_secret' => 'q3fylDTAshgLHWDjumQhZiOxopYaeEOeBAauoqJb',
            'username' => 'sss@laravel.com',
            'password' => 'sss',
            'scope' => '',
        ],
    ]);

    return json_decode((string)$response->getBody(), true);
});


Route::get('vue',function(){
    return view('vue');
});