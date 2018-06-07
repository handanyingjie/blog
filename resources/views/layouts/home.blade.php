<!doctype html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>木庄网络博客-MZ-NetBlog主题模板</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    {{--<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css')  }}">--}}
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/nprogress.css')  }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css')  }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/font-awesome.min.css')  }}">
    <link rel="apple-touch-icon-precomposed" href="{{ asset('images/icon.png')  }}">
    <link rel="shortcut icon" href="{{ asset('images/favicon.ico')  }}">
    <script src="{{ asset('js/jquery-2.1.4.min.js')  }}"></script>
    <script src="{{ asset('js/nprogress.js')  }}"></script>
    <script src="{{ asset('js/jquery.lazyload.min.js')  }}"></script>
    <!--[if gte IE 9]>
    <script src="{{ asset('js/jquery-1.11.1.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/html5shiv.min.js')  }}" type="text/javascript"></script>
    <script src="{{ asset('js/respond.min.js')  }}" type="text/javascript"></script>
    <script src="{{ asset('js/selectivizr-min.js')  }}" type="text/javascript"></script>
    <![endif]-->
    <!--[if lt IE 9]>
    <script>window.location.href = 'upgrade-browser.html';</script>
    <![endif]-->
</head>
<body class="user-select">
<header class="header">
    <nav class="navbar navbar-default" id="navbar">
        <div class="container">
            <div class="header-topbar hidden-xs link-border">
                <ul class="site-nav topmenu">
                    <li><a href="http://www.muzhuangnet.com/tags/" >标签云</a></li>
                    <li><a href="http://www.muzhuangnet.com/readers/" rel="nofollow" >读者墙</a></li>
                    <li><a href="http://www.muzhuangnet.com/rss.html" title="RSS订阅" >
                            <i class="fa fa-rss">
                            </i> RSS订阅
                        </a></li>
                </ul>
                勤记录 懂分享</div>
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#header-navbar" aria-expanded="false"> <span class="sr-only"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                <h1 class="logo hvr-bounce-in"><a href="http://www.muzhuangnet.com/" title="木庄网络博客"><img src="http://www.muzhuangnet.com/upload/201610/17/201610171329086541.png" alt="木庄网络博客"></a></h1>
            </div>
            <div class="collapse navbar-collapse" id="header-navbar">
                <form class="navbar-form visible-xs" action="/Search" method="post">
                    <div class="input-group">
                        <input type="text" name="keyword" class="form-control" placeholder="请输入关键字" maxlength="20" autocomplete="off">
                        <span class="input-group-btn">
            <button class="btn btn-default btn-search" name="search" type="submit">搜索</button>
            </span> </div>
                </form>
                <ul class="nav navbar-nav navbar-right">
                    <li><a data-cont="木庄网络博客" title="木庄网络博客" href="{{ route('home_index')  }}">首页</a></li>
                    <li><a data-cont="IT技术笔记" title="IT技术笔记" href="{{  route('home_article') }}" >IT技术笔记</a></li>
                    <li><a data-cont="源码分享" title="源码分享" href="http://www.muzhuangnet.com/list/share/" >源码分享</a></li>
                </ul>
            </div>
        </div>
    </nav>
</header>
<section class="container">
    <div class="content-wrap">
        <div class="content">
            @yield('content')
        </div>
    </div>
    @section('sidebar')
    @show
</section>
<footer class="footer">
    <div class="container">
        <p>本站[<a href="http://www.muzhuangnet.com/" >木庄网络博客</a>]的部分内容来源于网络，若侵犯到您的利益，请联系站长删除！谢谢！Powered By [<a href="http://www.dtcms.net/" target="_blank" rel="nofollow" >DTcms</a>] Version 4.0 &nbsp;<a href="http://www.miitbeian.gov.cn/" target="_blank" rel="nofollow" >闽ICP备00000000号-1</a> &nbsp; <a href="http://www.muzhuangnet.com/sitemap.xml" target="_blank" class="sitemap" >网站地图</a></p>
    </div>
    <div id="gotop"><a class="gotop"></a></div>
</footer>
{{--<script src="{{ asset('js/bootstrap.min.js')  }}"></script>--}}
<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="{{ asset('js/jquery.ias.js')  }}"></script>
<script src="{{ asset('js/scripts.js')  }}"></script>
</body>
</html>