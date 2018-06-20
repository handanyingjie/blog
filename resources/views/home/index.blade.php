@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">forum Threads</div>

                    <div class="panel-body">
                        @foreach($posts as $post)
                            <article>
                                <a href="{{ route('home_show',['post' => $post->id]) }}">
                                    <h4>{{ $post->title }}</h4>
                                </a>
                            </article>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection