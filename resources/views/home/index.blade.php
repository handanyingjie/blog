<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
<div id="app">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    &nbsp;
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    <li class="dropdown">
                        <a href="#">
                            PHP
                        </a>
                    </li>
                    <li class="dropdown">
                        <a href="#">
                            Linux
                        </a>
                    </li>
                    <li class="dropdown">
                        <a href="#">
                            Vue
                        </a>
                    </li>
                    <li class="dropdown">
                        <a href="#">
                            Redis
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <router-view></router-view>
            </div>
            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading">个人资料</div>
                    <ul class="list-inline" style="padding: 12px">
                        <li class="list-inline-item">
                            <a class="badge badge-pill badge-light border pull-left">Linux</a>
                        </li>
                        <li class="list-inline-item">
                            <a class="badge badge-pill badge-light border pull-left">PHP</a>
                        </li>
                        <li class="list-inline-item">
                            <a class="badge badge-pill badge-light border pull-left">PHP</a>
                        </li>
                        <li class="list-inline-item">
                            <a class="badge badge-pill badge-light border pull-left">Linux</a>
                        </li>
                        <li class="list-inline-item">
                            <a class="badge badge-pill badge-light border pull-left">PHP</a>
                        </li>
                        <li class="list-inline-item">
                            <a class="badge badge-pill badge-light border pull-left">PHP</a>
                        </li>
                    </ul>
                </div>
                <tags></tags>
                <div class="panel panel-default">
                    <div class="panel-heading">最新文章</div>
                    <ul class="list-inline" style="padding: 12px">
                        <li class="list-inline-item">
                            <a class="badge badge-pill badge-light border pull-left">Linux</a>
                        </li>
                        <li class="list-inline-item">
                            <a class="badge badge-pill badge-light border pull-left">PHP</a>
                        </li>
                        <li class="list-inline-item">
                            <a class="badge badge-pill badge-light border pull-left">PHP</a>
                        </li>
                        <li class="list-inline-item">
                            <a class="badge badge-pill badge-light border pull-left">Linux</a>
                        </li>
                        <li class="list-inline-item">
                            <a class="badge badge-pill badge-light border pull-left">PHP</a>
                        </li>
                        <li class="list-inline-item">
                            <a class="badge badge-pill badge-light border pull-left">PHP</a>
                        </li>
                    </ul>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">热门文章</div>
                    <ul class="list-inline" style="padding: 12px">
                        <li class="list-inline-item">
                            <a class="badge badge-pill badge-light border pull-left">Linux</a>
                        </li>
                        <li class="list-inline-item">
                            <a class="badge badge-pill badge-light border pull-left">PHP</a>
                        </li>
                        <li class="list-inline-item">
                            <a class="badge badge-pill badge-light border pull-left">PHP</a>
                        </li>
                        <li class="list-inline-item">
                            <a class="badge badge-pill badge-light border pull-left">Linux</a>
                        </li>
                        <li class="list-inline-item">
                            <a class="badge badge-pill badge-light border pull-left">PHP</a>
                        </li>
                        <li class="list-inline-item">
                            <a class="badge badge-pill badge-light border pull-left">PHP</a>
                        </li>
                    </ul>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">最新评论</div>
                    <ul class="list-inline" style="padding: 12px">
                        <li class="list-inline-item">
                            <a class="badge badge-pill badge-light border pull-left">Linux</a>
                        </li>
                        <li class="list-inline-item">
                            <a class="badge badge-pill badge-light border pull-left">PHP</a>
                        </li>
                        <li class="list-inline-item">
                            <a class="badge badge-pill badge-light border pull-left">PHP</a>
                        </li>
                        <li class="list-inline-item">
                            <a class="badge badge-pill badge-light border pull-left">Linux</a>
                        </li>
                        <li class="list-inline-item">
                            <a class="badge badge-pill badge-light border pull-left">PHP</a>
                        </li>
                        <li class="list-inline-item">
                            <a class="badge badge-pill badge-light border pull-left">PHP</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
