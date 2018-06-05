<?php
/**
 * Created by PhpStorm.
 * User: huolian
 * Date: 2018/6/1
 * Time: 下午4:10
 */
namespace App\Models;

use App\Http\Controllers\Api\BaseApiController;
use App\Models\BasicModel;
use App\Users;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LoginModel extends BasicModel
{
    protected $table = 'Users';
    public function login($data){

        $BaseApiController = new BaseApiController();
        $info['name'] = !empty($data['username']) ? $data['username'] : '';
        $info['password'] = !empty($data['password']) ? $data['password'] : '';

        if($info['name'] == '' || $info['name'] == null){
            return response()->json('name empty' ,-1);
        }
        if($info['password'] == '' || $info['password'] == null){
            return response()->json('password empty' ,-1);
        }

        $userInfo = DB::table('users')->select('id','name','email','password')->where('name','=',$info['name'])->get()->toArray();

        if(empty($userInfo) || !$userInfo){

            return response()->json($BaseApiController->resultJsonStatus(0,'账号有误'));
        }

        foreach($userInfo as $index=> $value){
            $user['id'] =  $value->id;
            $user['name'] = $value->name;
            $user['email'] =  $value->email;
            $user['password'] =  $value->password;

        }

        //check()第一个参数是你表单提交接到的值  第二个值是从你的数据库取出的bcript以后的密码
        if(!Hash::check(decrypt($info['password']), $user['password'])){
            return reponse()->json($BaseApiController->resultJsonStatus(0,'密码错误'));
        }

        $user['status'] = 'successful';

        return $user;

    }
}