@extends('article.common.base')
{{-- 覆盖不可用 --}}
{{--
@section("title")
    Artilce|测试titlesss
    @endsection
--}}

@section('content')
    <div class="container" style="height: 500px;text-align: center;">
        <h1 style="position: absolute;left: 35%;top: 30%;">继承模板的主页搞定了！</h1>
        {{-- 这里是Blade注释 --}}
    </div>
@endsection

