<?php
/**
 * Created by PhpStorm.
 * User: huolian
 * Date: 2018/6/1
 * Time: 上午10:42
 */

namespace App\Models;

use App\Users;
use App\Models\BasicModel;
use App\Http\Controllers\Api\TokenController;
use Illuminate\Database\Eloquent\SoftDeletes;

class RegisterModel extends BasicModel
{
    use SoftDeletes;

    protected $table = 'users';

    public function saveInfo($info = []){

        $data = $this->checkData($info);

        $data['created_at'] = date('Y-m-d H:i:s', time());
        $insert = [
            'name' => $data['username'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'created_at' => $data['created_at']
        ];

        $uniqe_name = Users::find($data['username']);

        if($data){

            return Users::insertGetId($insert);
            //return Users::whereId('31')->update($insert);
        }else{
            throw new Exception("数据入库，请求异常");
        }

    }

    protected function checkData($info = []){

        $data['username'] = !empty($info['username']) ? $info['username'] : '';
        $data['password'] = !empty($info['password']) ? $info['password'] : '';
        $data['email'] = !empty($info['email']) ? $info['email'] : '';

        if($data['username'] == '' || $data['username'] == null){
            return response()->json('username empty',-1);
        }

        if ($data['password'] == '' || $data['password'] == null){
            return response()->json('password empty',-2);
        }

        $data['password'] = decrypt($data['password']);

        return $data;
    }
}