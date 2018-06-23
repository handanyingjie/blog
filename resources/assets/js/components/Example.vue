<template>
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <!--<breadcrumb-nav></breadcrumb-nav>-->
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
</template>

<script>
    export default {
        data: function () {
            return {

            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
