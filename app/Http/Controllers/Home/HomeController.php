<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\TestService;
use PhpOffice\PhpWord\Element\Object;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->testService = new TestService();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $testList = [];
        $testList = $this->testService->getList();
        var_dump($testList);die;
        /*
         foreach ($testList as $key => $value) {
               $testList = $testList[$key] = $value;
         }
         dd($testList);
      */
         $data = [
                'testList' => $testList,
         ];
         return view('home/index',$data);
    }

    public function addData(Request $request){
            $data = array();
            if (empty($request->input('name') || $request->input('age'))) {
                return redirect("/testInsert");
            }
            $data['name'] = $request->input('name');
            $data['age'] = $request->input('age');
            $data['sex'] = $request->input('sex');
            $data['phone'] = $request->input('phone');

            $result = $this->testService->saveInfo($data);
            return $this->index();
    }
    public function deleteInfo($id){

            $result = $this->testService->deleteInfo($id);
            return $this->index();
    }

    public function dataInfo(){
        // 分块结果
        $dataContent = $this->testService->orderBy('id')->chunk(2,function ($users){
            foreach($users as $key => $user){
                print_r($user);
            }
        });
        //print_r($dataContent);
        //查询 个别数据
        $this->testService->select('id','email as user_email')->get();

        //强制不重复数据
        $this->testService->distinct()->get();

        //追加查询字段
        $this->testService->select('name');
        $this->testService->addSelect('phone')->get();

        //原始表达式 DB::raw() 避免SQL注入
        $this->testService->select(DB::raw('count(*) as user_count,status'))
            ->where('id','<>',1)
            ->groupBy('id')
            ->get();

        // Inner Join 内连接
        $this->testService
            ->join('user','user.id','=','test.id')
            ->select('user.*','test.*')
            ->get();

        // Left join 左连接查询 以左表为主 来查询
        $this->testService->leftJoin('user','test.id','=','user.id')->get();

        // Cross Join 交叉连接
        //使用 crossJoin 方法和你想要交叉连接的表名来做「交叉连接」。交叉连接通过第一个表和连接表生成一个笛卡尔积：
        $this->testService->crossJoin('user')->get();

        //高级 Join 语法
        //让我们传递一个闭包作为 join 方法的第二个参数来作为开始。此闭包将会收到一个 JoinClause 对象，让你可以在 join 子句中指定约束：
        $this->testService->join('user',function($join){
            $join->on('user.id','=','test.id')->orOn('test.id','=','user.id');
        })->get();

        $this->testService->join('user',function($join){
            $join->on('user.id','=','test.id')
                ->where('id','>','0');
        })->get();

        // Union 联合查询
        $this->testService->unionAll('user')->get();

        //使用数组where 来进行查询条件
        $this->testService->where([
            ['id','=','1'],
            ['name','=','bufuqing']
        ])->get();

        //使用orwhere 来约束查询
        $this->testService->where('id','=','1')->orwhere('name','=','bufuqing')->get();

        //whereBetween 俩个值之间的 数据
        $this->testService->whereBetween('id',['1,100'])->get();

        //whereBetween 不在俩个值之间的 数据
        $this->testService->whereNotBetween('id',['1,100'])->get();

        //whereColumn 检测两个列的数据是否一致
        $this->testService->whereCoulmn('deleted_at','updated_at')->get();

        //参数分组
        $this->testService->where('id','=','1')->orwhere(function ($query){
            $query->where('id','=','1')->where('name','=','bufuqing');
        })->get();

        //where Exists 检测SQL子语句查找
        $this->testService->whereExists(function ($query){
            $query->select(DB::raw(1))
                ->from('user')
                ->whereRaw('user.id','=','test.id');
        })->get();

        //JSON 查询语句
        $this->testService->where('options->language','en')->get();
        $this->testService->where('prefereces->dinging->meal','salad')->get();

        //latest 和 oldest 方法允许你更容易的依据日期对查询结果排序。默认查询结果将依据 created_at 列。或者,你可以使用字段名称排序：
        $this->testService->latest()->first();
        $this->testService->oldest()->first();

        //inRandomOrder 方法可以将查询结果随机排序。例如，你可以使用这个方法获取一个随机用户：
        $this->testService->inRandomOrder()->first();

        //groupBy 和 having 方法可用来对查询结果进行分组。having 方法的用法和 where 方法类似：
        $this->testService->groupBy('id')->having('id', '>', 100)->get();

        //havingRaw 方法可以将一个原始的表达式设置为 having 子句的值。例如，我们能找出所有销售额超过 2,500 元的部门：
        $this->testService->select('test', DB::raw('SUM(age) as total_age'))
            ->groupBy('id')
            ->havingRaw('SUM(age) > 250')
            ->get();

        //你可以使用 skip 和 take 方法来限制查询结果数量或略过指定数量的查询：
        $this->testService->skip(10)->take(5)->get();
        //你也可以使用 limit 和 offset 方法：
        $this->testService->offset(10)->limit(5)->get();

        //条件语句
        $request = Object::class;
        $role = $request->input('role');
        $this->testService->when($role, function ($query) use ($role) {
            return $query->where('role_id', $role);
        })->get();

        //悲观锁
        //查询构造器也包含一些可以帮助你在 select 语法上实现「悲观锁定」的函数 。
        //若要在查询中使用「共享锁」，可以使用 sharedLock 方法。共享锁可防止选中的数据列被篡改，
        //直到事务被提交为止：
        $this->testService->where('id','=','1')->shareLock()->get();
        //另外，你也可以使用 lockForUpdate 方法。使用「更新」锁可避免行被其它共享锁修改或选取：
        $this->testService->where('id', '>', 0)->lockForUpdate()->get();
    }





}
