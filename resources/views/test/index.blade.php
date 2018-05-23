

@extends("test/header")

@include("test/header")
hai

@extends("test.foot")


<hr>
现在时间是：
{{date("Y-m-d H:i:s")}}

<hr>
<html>
11111
</html>


<hr>





@section('content')
    @yield("test/zhanwei")

    section 中间的位置
@endsection

<hr>

ssss

{{$name}}
{{$age}}
{{$sex}}
