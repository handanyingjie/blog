<template>
    <div class="container" id="register">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
                <form class="form-horizontal" role="form">
                    <div class="form-group">
                        <label for="email" class="col-sm-2 control-label">邮箱:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="email" placeholder="请输入账号" v-model="form.email">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-sm-2 control-label">密码:</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="password" placeholder="请输入密码" v-model="form.password">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                        <div class="checkbox">
                        <label>
                        <input type="checkbox" v-model="form.remember">请记住我
                        </label>
                        </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-default" @click="toLogin">登陆</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
    import { login, user } from '../../api/api.js'

    export default {
        data: function () {
            return {
                form: {
                    'email': '',
                    'password': '',
                    'remember': 0
                }
            };
        },
        methods: {
            toLogin(){
                const data = Object.assign(this.form, { _token: Laravel.csrfToken });
                login(data).then(response => {
                    if(response.data.status == '200'){
                        this.$router.push({ path: '/' });
                    }
                }).catch(err => {
                    console.log(err.toString())
                })
            }
        }
    }
</script>
<style>
    #register {
        margin-top: 160px;
    }
</style>