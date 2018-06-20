@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-9 pull-left">
                <div class="panel panel-default">
                    <div class="panel-heading">forum Threads</div>

                    <div class="panel-body">
                        @foreach($posts as $post)
                            <article>
                                <a href="{{ route('home_show',['post' => $post->id]) }}">
                                    <h4>{{ $post->title }}</h4>
                                </a>
                                <p class="meta">
                                    <time class="time"><i class="glyphicon glyphicon-time"></i> {{ $post->created_at }}</time>
                                    <span class="views"><i class="glyphicon glyphicon-eye-open"></i> 217</span>
                                    <a class="comment" href="http://www.muzhuangnet.com/show/269.html#comment" title="评论" target="_blank">
                                        <i class="glyphicon glyphicon-comment"></i> 4</a>
                                </p>

                            </article>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-3 pull-right">
                <div class="panel panel-default">
                    <div class="panel-heading">标签</div>

                    <div class="panel-body">
                        @foreach($tags as $tag)
                            <button type="button" class="btn btn-primary btn-sm" style="margin-bottom: 5px">{{ $tag->name }}</button>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
