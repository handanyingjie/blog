@extends('admin.admin')
@section('other-css')

@endsection
@section('content-header')
    <h1>
        标签管理
        <small>标签</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('admin_index')}}"><i class="fa fa-dashboard"></i> 主页</a></li>
        <li class="active"><a href="{{route('tag_index')}}">标签管理 - 标签</a></li>
    </ol>
@stop
@section('content')
    <h2 class="page-header">添加新标签</h2>
    <form action="{{ route('tag_create') }}" method="POST" accept-charset="utf-8">
        {!! csrf_field() !!}
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#tab_1" data-toggle="tab" aria-expanded="true">主要内容</a>
                </li>
            </ul>

            <div class="tab-content">

                <div class="tab-pane active" id="tab_1">
                    <div class="form-group" {{ $errors->has('name') ? 'has-error' : '' }}>
                        <label>标签
                            <small class="text-red">*</small>
                        </label>
                        <input required="required" type="text" class="form-control" name="name" autocomplete="off"
                               placeholder="标签" maxlength="80" value="{{ old('name') }}">

                        @if($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">保存</button>
            </div>
        </div>
    </form>
@stop