<?php

use Illuminate\Http\Request;
use App\Article;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
/*
Route::middleware(['auth:api'])->get('/user', function (Request $request) {
    return $request->user();
});
*/
/*
Route::get("articles",function(){
    // If the Content-Type and Accept headers are set to 'application/json',
    // this will return a JSON structure. This will be cleaned up later.
    return Article::all();
});

Route::get("articles/{id}",function($id){
   return Article::find($id);
});

Route::post('articles',function(Request $request){
    return Article::create($request->all());
});

Route::put('articles/{id}',function (Request $request, $id){
    $article = Article::findOrFail($id);
    $article->update($request->all());
    return $article;
});

Route::delete('articles/{id}',function (Request $request,$id){
    Article::find($id)->delete();
    return 204;
});
*/
/*
Route::get('articles','ArticleController@index');
Route::get('articles/{id}','ArticleController@show');
Route::post('articles','ArticleController@store');
Route::put('articles{id}','ArticleController@update');
Route::delete('articles/{id}','ArticleController@delete');
*/

Route::get('/','IndexController@index');
Route::post('register','Auth\RegisterController@register');
Route::post('login', 'Auth\LoginController@login');

//对需要操作的内容，需要 验证登陆，成功之后才能登陆
Route::group(['middleware'=>'auth:api'],function(){

    Route::post('logout','Auth\LoginController@logout');
    //隐式路由模型绑定来改写路由定义：
    Route::get('articles','ArticleController@index');

    Route::get('articles/{article}','ArticleController@show');
    Route::post('articles','ArticleController@store');
    Route::put('articles{article}','ArticleController@update');
    Route::delete('articles/{article}','ArticleController@delete');

});


Route::get('/redirect',function(){

    $query = http_build_query([
        'client_id' => 4,
        'redirect_url' => 'http://laravel55.com/auth/callback',
        'response_type' => 'code',
        'scope' => 'pWTIcgNEe2eo3UlC3wTSHjQSuHjh3dMIHadi56XJ',
    ]);

    return redirect("http://".$_SERVER['HTTP_HOST']."/oauth/authorize?".$query);
});

/*
 * api 模拟登陆注册接口
 */
Route::group(['prefix'=>'api2','namespace'=>'Api'],function(){
    //Route::get('/','LoginController@login');
//    Route::get('client','ClientController@getDataFromServer');
    Route::get('client','ClienterController@getDataFromServer');

    Route::get('register','RegisterController@register');

    Route::get('login','LoginController@login');

    //sort
    Route::get('sort','RegisterController@sort');
});
