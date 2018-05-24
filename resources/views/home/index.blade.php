<div>
	<div>
	<a href="{{url('/testInsert')}}">添加数据</a>
		<table border="0">
			<tr>
				<th>id</th>
				<th>name</th>
				<th>age</th>
				<th>sex</th>
				<th>操作</th>
			</tr>
			@foreach($testList as $keys => $value)
			<tr>
				<td>{{$value['id']}}  </td> 
				<td>{{$value['name']}}</td>
				<td>{{$value['age']}}</td>
				<td>{{$value['sex']}}</td>
				<td> <a href="{{url('/deleteInfo/'.$value['id'])}}">删除</a></td>
			</tr>
			@endforeach
			
		</table>
	</div>
</div>