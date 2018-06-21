@extends('layouts.home')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">最新文章</div>
                    <ul class="list-group">
                        @foreach($posts as $post)
                            <li class="list-group-item">
                                <a href="{{ route('home_show',['post' => $post->id]) }}">
                                    <h4>{{ $post->title }}</h4>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection