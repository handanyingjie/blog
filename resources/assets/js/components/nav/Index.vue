<template>
    <div id="nav">
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <!--<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">-->
                        <!--<span class="sr-only">Toggle Navigation</span>-->
                        <!--<span class="icon-bar"></span>-->
                        <!--<span class="icon-bar"></span>-->
                        <!--<span class="icon-bar"></span>-->
                    <!--</button>-->

                    <!-- Branding Image -->
                    <!--<a class="navbar-brand" :to="{ path: '/' }">-->
                        <!--编程改变世界-->
                    <!--</a>-->
                    <router-link class="navbar-brand" :to="{ path: '/'}">
                        编程改变世界
                    </router-link>
                </div>

                <!--<div class="collapse navbar-collapse" id="app-navbar-collapse">-->
                    <!--&lt;!&ndash; Left Side Of Navbar &ndash;&gt;-->
                    <!--&lt;!&ndash; Right Side Of Navbar &ndash;&gt;-->
                    <!--<ul class="nav navbar-nav">-->
                        <!--&lt;!&ndash; Authentication Links &ndash;&gt;-->
                        <!--<router-link tag="li" :to="{ path: '/' }">-->
                            <!--<a class="dropdown">首页</a>-->
                        <!--</router-link>-->
                    <!--</ul>-->
                <!--</div>-->
            </div>
        </nav>
    </div>
</template>

<script>
    import { Bus } from '../../api/bus.js';
    export default {
        data(){
            return {
                uid: 0
            }
        },
        created() {
            Bus.$on('isLogin', uid => {
                this.uid = uid;
                console.log(uid);
            });
        }
    }
</script>

<style scoped>

</style>