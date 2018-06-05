<?php
/**
 * Created by PhpStorm.
 * User: huolian
 * Date: 2018/6/4
 * Time: 下午5:59
 */
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseApiController;
use App\Models\CommentModel;
use App\Http\Controllers\Api\TokenController;

class CommentController extends BaseApiController
{
    public function __construct($user = null)
    {
       // parent::__construct($user);
        $this->TokenController = new TokenController();
        $this->CommentModel = new CommentModel();
    }

    public function comment(Request $request){

       $resonse = $request->input();
      // return $resonse;
        $this->TokenController->Verification($resonse['clientToken'],$resonse['loginToken']);
        //入库
       $result = $this->CommentModel->comment($resonse);
       return $result;
    }

}