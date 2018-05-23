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
Route::post('register','Auth\RegisterController@register');
Route::post('login', 'Auth\LoginController@login');


Route::group(['middleware'=>'auth:api'],function(){

    Route::post('logout','Auth\LoginController@logout');
    //隐式路由模型绑定来改写路由定义：
    Route::get('articles','ArticleController@index');

    Route::get('articles/{article}','ArticleController@show');
    Route::post('articles','ArticleController@store');
    Route::put('articles{article}','ArticleController@update');
    Route::delete('articles/{article}','ArticleController@delete');

});

