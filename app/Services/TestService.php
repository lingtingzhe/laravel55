<?php
namespace App\Services;
/*
 * Services 服务层：调用Model 层的数据
 *  返回结果： 给Controller层
*/

use App\Models\TestModel;
use App\Models\Test;

class TestService extends Test
{
	public function __construct(){
		$this->testModel = new Test();
	}
	
	//public function getList($requestData = [], $perPage = null, $limit = null, $order = [] )
	public function getList()
	{
		return $this->testModel->getList();
	}

	public function saveInfo($data){
		return $this->testModel->saveInfo($data);
	}

	public function deleteInfo($data){
		return $this->testModel->deleteInfo($data);
	}

}