<template>
    <div class="container" id="register">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
                <form class="form-horizontal" role="form">
                    <div class="form-group">
                        <label for="email" class="col-sm-2 control-label">邮箱:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="email" placeholder="请输入账号">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-sm-2 control-label">密码:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="password" placeholder="请输入密码">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                        <div class="checkbox">
                        <label>
                        <input type="checkbox">请记住我
                        </label>
                        </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-default">登陆</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
    export default {}
</script>
<style>
    #register {
        margin-top: 160px;
    }
</style>