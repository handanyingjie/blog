<template>
    <div id="nav">
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand">
                        编程改变世界
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
                        <router-link tag="li" :to="{ path: '/' }">
                            <a class="dropdown">首页</a>
                        </router-link>
                        <router-link tag="li" :to="{ path: '/register' }">
                            <a>
                                <span class="glyphicon glyphicon-user"></span> 注册
                            </a>
                        </router-link>
                        <router-link tag="li" :to="{ path: '/login' }">
                            <a>
                                <span class="glyphicon glyphicon-log-in"></span> 登录
                            </a>
                        </router-link>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</template>

<script>
    export default {
    }
</script>

<style scoped>

</style>