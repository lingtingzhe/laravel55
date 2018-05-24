<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<!-- <meta name="csrf-token" content="{{ csrf_token() }}"> -->
	<title>title|Insert_Article</title>
</head>
<body>
<form  method="POST" action="{{ url('/addData') }}" >
  <!-- <input type="hidden" name="token" value=" {{ csrf_field() }}"> -->
{{ csrf_field() }}
<table>
	<tr>
		<td> 
			<label for="search">模糊搜索：</label>
			<input type="text" name="search" style="width: 400px" class="form-control" id="search" placeholder="请输入用户名或者邮箱或者电话" value="{{request('search')}}">	 
		</td> 
	</tr> 
	<tr>
		<td> <input type="text" name="name" placeholder="请输入姓名">姓名</input></td>
	</tr>
	 <tr>
	 	<td><input type="text" name="age" placeholder="请输入年轮">年轮</input></td>
	 </tr>
	 <tr>
	 	<td><input type="text" name="sex" placeholder="请输入性别">性别</input></td>
	 </tr>
	 <tr>
	 	<td> <input type="text" name="phone" placeholder="请输入手机号">手机号</input></td>
	 </tr>
	 <tr>
	 	<td><input type="submit" name="" value="提交"></td>
	 </tr>
  </table> 

</form>
</body>
</html>
