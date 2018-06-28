<template>
    <div class="panel panel-default">
        <div class="panel-heading">个人资料</div>
        <div class="panel-body text-center">
            <a>
                <img class="img-thumbnail avatar" src=".././header.jpg" alt=""
                     style="width: 80px; height: 80px;margin-top: 5px;">
            </a>
            <div class="media-body padding-top-sm">
                <div class="media-heading">
                    <span class="introduction">
                        业精于勤,荒于嬉<br>行成于思,毁于随
                    </span>
                </div>
                <ul class="list-inline">
                    <li class="popover-with-html" data-content="真实姓名" data-original-title="">
                                    <span class="org">
                                        <i class="glyphicon glyphicon-user"></i>
                                        刘英杰
                                    </span>
                    </li>
                    <li>
                        <a class="popover-with-html" href="https://github.com/handanyingjie?tab=repositories">
                            <i class="fa fa-github-alt"></i>
                            Github
                        </a>
                    </li>
                </ul>
                <!--<div class="clearfix"></div>-->
                <!--<span class="text-white">-->
                    <!--<a class="btn btn-default btn-block">-->
                        <!--<i class="fa fa-envelope-o"></i>-->
                        <!--发私信-->
                    <!--</a>-->
                <!--</span>-->
            </div>
        </div>
    </div>
</template>
<script>
    export default {}
</script>
<style scoped>
    .avatar {
        border-radius: 50%;
    }
</style>