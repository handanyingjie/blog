@extends('admin.admin')
@section('content-header')
    <h1>
        标签管理
        <small>标签</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{url('/dashboard')}}"><i class="fa fa-dashboard"></i> 主页</a></li>
        <li class="active">标签管理 - 标签</li>
    </ol>
@stop

@section('content')
    <a href="{{ route('tag_create') }}" class="btn btn-primary margin-bottom">添加新标签</a>
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">标签列表</h3>
        </div>
        <div class="box-body table-responsive">
            <table  class="table table-hover table-bordered">
                <tbody>
                    <tr>
                        <th>操作</th>
                        <th>标签</th>
                        <th>文章数量</th>
                    </tr>
                    @foreach($tags as $tag)
                        <tr>
                            <td>
                                <a style="font-size: 16px" href="{{ route('tag_edit',['id' =>$tag['id']])}}"><i class="fa fa-fw fa-pencil" title="修改"></i></a>
                                <a style="font-size: 16px" href="#" onclick="event.preventDefault();
                                        document.getElementById('delete-form-{{ $tag['id'] }}').submit();"><i class="fa fa-fw fa-trash-o" title="删除"></i></a>
                                <form action="{{ route('tag_destroy',['id' => $tag['id']]) }}" method="POST" id="delete-form-{{ $tag['id'] }}">
                                    {!! csrf_field() !!}
                                    {!! method_field('put') !!}
                                </form>
                            </td>
                            <td class="text-muted">{{ $tag['name'] }}</td>
                            <td class="text-muted">{{ $tag['name'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop
