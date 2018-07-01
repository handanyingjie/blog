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
                <span class="text-white">
                    <a class="btn btn-default btn-block" data-target="#myModal" data-toggle="modal">
                        <i class="fa fa-envelope-o"></i>
                        发私信
                    </a>
                </span>
            </div>
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">发送邮件</h4>
                        </div>
                        <div class="modal-body">
                            <form class="form-horizontal">
                                <div class="form-group">
                                    <label for="recipient-name" class="col-sm-2 control-label">邮箱:</label>
                                    <div class="col-sm-10">
                                        <input type="email" v-model="form.email" class="form-control" id="recipient-name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="recipient-title" class="col-sm-2 control-label">标题:</label>
                                    <div class="col-sm-10">
                                        <input type="email" v-model="form.title" class="form-control" id="recipient-title">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="message-text" class="col-sm-2 control-label">内容:</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" v-model="form.message" id="message-text"></textarea>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal" ref="close">关闭</button>
                            <button type="button" class="btn btn-primary" @click="save">提交</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import { email } from '../../api/api.js';
    import { Bus } from '../../api/bus.js';
    export default {
        data() {
            return {
                form: {
                    title: '',
                    email: '',
                    message: ''
                }
            }
        },
        methods: {
            save: function() {
                if(!/^[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*\.[a-zA-Z0-9]{2,6}$/.test(this.form.email)){
                    alert("邮箱格式错误!")
                    return
                }
                if(!this.form.title || !this.form.message){
                    alert('标题和内容不可为空!')
                    return
                }
                email(this.form).then( response => {
                    if(response.data == 'ok'){
                        // alert('ok');
                        this.$refs['close'].click()
                    }
                } ).catch( err => {
                    console.log(err.toString())
                } )
            }
        }
    }
</script>
<style scoped>
    .avatar {
        border-radius: 50%;
    }
    textarea {
        resize: none;
    }
</style>