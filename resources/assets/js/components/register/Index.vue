<template>
    <div class="container" id="register">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
                <form class="form-horizontal" role="form">
                    <div class="form-group">
                        <label for="email" class="col-sm-2 control-label"><small class="text-red">*</small>邮箱:</label>
                        <div class="col-sm-7">
                            <input type="email" class="form-control" id="email" placeholder="请输入邮箱" v-model="registerForm.email">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-sm-2 control-label"><small class="text-red">*</small>密码:</label>
                        <div class="col-sm-7">
                            <input type="password" class="form-control" id="password" placeholder="请输入密码" v-model="registerForm.password">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="confirmation" class="col-sm-2 control-label"><small class="text-red">*</small>确认密码:</label>
                        <div class="col-sm-7">
                            <input type="password" class="form-control" id="confirmation" placeholder="请输入密码" v-model="registerForm.password_confirmation">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nickname" class="col-sm-2 control-label">昵称:</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="nickname" placeholder="请输入账号" v-model="registerForm.nickname">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-default" @click="register">注册</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
    import { register, code } from '../../api/api.js'
    export default {
        data: function () {
            return {
                registerForm: {
                    email: '',
                    nickname: '',
                    password: '',
                    password_confirmation: '',
                    _token: Laravel.csrfToken
                }
            }
        },
        methods: {
            getCode () {
                code({ email: this.registerForm.email, _token: Laravel.csrfToken }).then( response => {


                } ).catch( err => {

                } )
            },
            register() {
                this.verify()
                register(this.registerForm).then(response => {
                    if (response.data.status == 200) {
                        alert(response.data.message)
                        this.$router.push({ path: '/' })
                        return
                    }
                    alert(response.data.message)
                }).catch( err => {} )
            },
            verify(){
                if(!/^[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*\.[a-zA-Z0-9]{2,6}$/.test(this.registerForm.email)){
                    alert("邮箱格式错误!")
                    return
                }
                if(!this.registerForm.password){
                    alert("密码不可为空!")
                    return
                }
                if(this.registerForm.password.length < 6){
                    alert("请输入不少于6个字符的密码!")
                    return
                }
            }
        }
    }
</script>
<style>
    #register {
        margin-top: 160px;
    }
    .text-red {
        color: red;
    }
</style>