<?php
/**
 * Created by PhpStorm.
 * User: lingtingzhe
 * Date: 2018/5/15 0015
 * Time: 上午 09:55
 */
namespace App\Http\Controllers\Home;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;


class EncryptController extends Controller {

    public function __construct()
    {

    }

    public function storeSecret($id='1'){

        $user = User::findOrFail($id);

        $user->fill([
            //'secret' => encrypt($request->secret)
            'password' => '1'
        ])->save();
//        $user->fill([])->save();
    }
    public function encryptString(){
        $encrypted = Crypt::encryptString('Hello world');
        $decrypted = Crypt::decryptString($encrypted);
        dd(['+'=>$encrypted,'-'=>$decrypted]);
    }



}