@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ $post->title }}
                    </div>

                    <div class="panel-body">
                        {!! Parsedown::instance()->text($post->body) !!}
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @foreach($post->replies as $reply)
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            {{ $reply->user->name }} 回复于
                            {{ $reply->created_at }}
                        </div>

                        <div class="panel-body">
                            {{ $reply->body }}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection