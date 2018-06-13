<?php
namespace App\Models;

use App\Models\BasicModel;
//use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Test extends BasicModel
{
	use SoftDeletes;
	 //使用软删除
    protected $dates = ['deleted_at'];

	protected $table = 'test';

    protected $fillable = ['name'];

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
	public function DeleteData()
    {

    }

    public function self()
    {
	    return new self();
    }

    public function getDataList()
    {
      return  self::where('id', 1)
            ->orderBy('name', 'desc')
            ->take(10)
            ->get();

//        foreach (self::all() as $flight) {
//            echo $flight->id;
//            echo '&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;';
//            echo $flight->name;
//            echo '<br />';
//        }
    }
    public function reject()
    {

        $flight =   self::where('id', 1)->orderBy('name', 'desc')->take(10)->get();

        $flights = $flight->reject(function ($flight) {
           // return $flight->cancelled;
           // return $flights;
        });
        return $flights;
    }

    public function chunks()
    {
        $data = Test::chunk(1, function ($flights) {
            foreach ($flights as $flight) {
                echo $flight->id;
                echo '<br/>';
            }
        });

        return $data;

    }

    public function findOrFails()
    {
        $model = Test::findOrFail(100);

        $model = Test::where('legs', '>', 100)->firstOrFail();
        return $model;
    }

    public function countAndmaxs()
    {
        return self::max('id');
        return self::min('id');
	    return self::count();
    }

    public function createds()
    {

       return  $flight = Test::create(['name' => 'Flight 10']);
       // return $flight->fill(['name' => 'Flight 22']);
    }

    public function del()
    {
        $flight = Test::find(8);
	    $result = $flight->delete();
	    return $result;
    }

    public function destroys()
    {

        return Test::destroy(10);
    }

    public function trashedsWith()
    {
//        $info = self::withTrashed()->whereId(8)->first();
        $info = self::withTrashed()->where('deleted_at','==','null')->get();
        $info = $info->history()->withTrashed()->get();
        return $info;
    }

    public function restores($id = 12)
    {
       // $info = self::find($id);

        $info = self::restore($id);
        return $info;

    }


}