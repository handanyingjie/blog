@extends('admin.admin')
@section('other-css')
    {!! editor_css() !!}
    <link href="//cdn.bootcss.com/select2/4.0.3/css/select2.min.css" rel="stylesheet">
@endsection
@section('content-header')
    <h1>
        内容管理
        <small>文章</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('admin_index')}}"><i class="fa fa-dashboard"></i> 主页</a></li>
        <li class="active"><a href="{{route('post_index')}}">内容管理 - 文章</a></li>
    </ol>
@stop

@section('content')
    <h2 class="page-header">编辑新文章</h2>
    <form method="POST" action="{{ route('post_update',['post' => $id]) }}" accept-charset="utf-8">
        {!! csrf_field() !!}
        {!! method_field('put') !!}
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">主要内容</a></li>
            </ul>

            <div class="tab-content">

                <div class="tab-pane active" id="tab_1">
                    <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}" >
                        <label>标题
                            <small class="text-red">*</small>
                        </label>
                        <input required="required" type="text" class="form-control" name="title" autocomplete="off"
                               placeholder="标题" maxlength="80" value="{{ $post['title'] }}">

                        @if($errors->has('title'))
                            <span class="help-block">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group {{ $errors->has('author') ? 'has-error' : '' }}">
                        <label>作者
                            <small class="text-red">*</small>
                        </label>
                        <input required="required" type="text" class="form-control" name="author" autocomplete="off"
                               placeholder="作者" maxlength="80" value="{{ $post['author'] }}">

                        @if($errors->has('author'))
                            <span class="help-block">
                                <strong>{{ $errors->first('author') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group {{ $errors->has('tag_id') ? 'has-error' : '' }}">
                        <label>选择标签
                            <small class="text-red">*</small>
                        </label>
                        <select class="js-example-basic-multiple form-control" multiple="multiple" name="tag_id[]">
                            @foreach($tags as $tag)
                                <option value="{{ $tag['id'] }}" @if(is_array($tag_id) && in_array($tag['id'],$tag_id)) selected @endif>{{ $tag['name'] }}</option>
                            @endforeach
                        </select>

                        @if($errors->has('tag_id'))
                            <span class="help-block">
                                <strong>{{ $errors->first('tag_id') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group {{ $errors->has('is_top') ? 'has-error' : '' }}">
                        <label>是否置顶
                            <small class="text-red">*</small>
                        </label>
                        <select class="js-example-placeholder-single form-control" name="is_top">
                            <option value=""></option>
                            @foreach($is_top as $key => $top)
                                <option value="{{$key}}" @if($key == $post['is_top']) selected @endif>{{ $top  }}</option>
                            @endforeach
                        </select>

                        @if($errors->has('is_top'))
                            <span class="help-block">
                                <strong>{{ $errors->first('is_top') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group {{ $errors->has('body') ? 'has-error' : '' }}">
                        <label>正文(Markdown)
                            <small class="text-red">*</small>
                            <span class="text-green">min:20</span></label>
                        <div id="editormd_id">
                            <textarea name="body" style="display:none;">{{ $post['body'] }}</textarea>
                        </div>

                        @if($errors->has('body'))
                            <span class="help-block">
                                <strong>{{ $errors->first('body') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">发布文章</button>
            </div>
        </div>
    </form>

@stop
@section('other-js')
    <script src="//cdn.bootcss.com/select2/4.0.3/js/select2.full.min.js"></script>
    {!! editor_js() !!}
    <script>
        $(".js-example-basic-multiple").select2({
            placeholder: "选择一个标签"
        });
        $(".js-example-placeholder-single").select2({
            placeholder: "选择是否置顶",
            allowClear: true
        });
    </script>
@endsection

