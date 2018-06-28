@extends('admin.admin')
@section('content-header')
    <h1>
        内容管理
        <small>文章</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{url('/dashboard')}}"><i class="fa fa-dashboard"></i> 主页</a></li>
        <li class="active">内容管理 - 文章</li>
    </ol>
@stop

@section('content')
    <a href="{{ route('post_create') }}" class="btn btn-primary margin-bottom">撰写新文章</a>
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">文章列表</h3>
            <div class="box-tools">
                <form action="" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control input-sm pull-right" name="s_title"
                               style="width: 150px;" placeholder="搜索文章标题">
                        <div class="input-group-btn">
                            <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="box-body table-responsive">
            <table class="table table-hover table-bordered">
                <tbody>
                <!--tr-th start-->
                <tr>
                    <th>操作</th>
                    <th>标题</th>
                    <th>作者</th>
                    <th>浏览次数</th>
                    <th>发布时间</th>
                    <th>更新时间</th>
                </tr>
                <!--tr-th end-->
                @foreach($posts as $post)
                    <tr>
                        <td>
                            {{--@if(0 === $post->published)--}}
                            <a style="font-size: 16px" href="{{ route('post_edit',['post' =>$post->id])}}"><i class="fa fa-fw fa-pencil" title="修改"></i></a>
                            {{--@endif--}}
                            <a style="font-size: 16px" href="#" onclick="event.preventDefault();
                                                     document.getElementById('delete-form-{{ $post->id }}').submit();"><i class="fa fa-fw fa-trash-o" title="删除"></i></a>
                            @if(0 === $post->published)
                            <a style="font-size: 16px" href="#" onclick="event.preventDefault();
                                                     document.getElementById('published-form-{{ $post->id }}').submit();"><i class="fa fa-fw fa-hand-o-up" title="发布"></i>
                            </a>
                            <form action="{{ route('post_published',['post' => $post->id]) }}" method="POST" id="published-form-{{ $post->id }}">
                                {!! csrf_field() !!}
                                {!! method_field('put') !!}
                            </form>
                            @elseif($post->published === 1)
                            <a style="font-size: 16px" href="#" onclick="event.preventDefault();
                                                     document.getElementById('unpublished-form-{{ $post->id }}').submit();"><i class="fa fa-fw fa-hand-o-down" title="取消发布"></i></a>
                                <form action="{{ route('post_unpublished',['post' => $post->id]) }}" method="POST" id="unpublished-form-{{ $post->id }}">
                                    {!! csrf_field() !!}
                                    {!! method_field('put') !!}
                                </form>
                            @endif
                            <form action="{{ route('post_destroy',['post' => $post->id]) }}" method="POST" id="delete-form-{{ $post->id }}">
                                {!! csrf_field() !!}
                                {!! method_field('delete') !!}
                            </form>
                        </td>
                        <td class="text-muted">{{ $post->title }}</td>
                        <td class="text-green">{{ $post->author }}</td>
                        <td class="text-red">233</td>
                        <td class="text-navy">{{ $post->created_at }}</td>
                        <td class="text-navy">{{ $post->updated_at }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop

