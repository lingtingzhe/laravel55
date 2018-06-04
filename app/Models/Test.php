<?php
namespace App\Models;

use App\Models\BasicModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use League\Flysystem\Exception;

class Test extends BasicModel
{
	use SoftDeletes;
	 //使用软删除
    protected $dates = ['deleted_at'];

	protected $table = 'test';

	public function getList()
	{
		return self::select('*')->get()->toArray();
	}
	
	public function saveInfo($data){
		if(isset($data['id']) && $data['id']){
			$id = $data['id'];
			unset($data['id']);

			return self::whereId($id)->update($data);
		}else{
			$data['created_at'] = date('Y-m-d H:i:s', time());
			return self::insertGetId($data);
		}
		
	}
	public function deleteInfo($id){
		$info = self::find($id);
		if(!$info){
			throw new Exception("请选择需要删除的数据");
		}
		return $info->delete();
	}

}