<template>
    <div id="detail">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            {{ post.title }}
                            <span class="pull-right">
                <span class="badge-span">
                    <i class="glyphicon glyphicon-eye-open"></i>
                    {{ post.pv }}
                </span>
                <time>
                    <i class="glyphicon glyphicon-time"></i>
                    {{ post.created_at }}
                </time>
            </span>
                        </div>

                        <div class="panel-body" v-html="post.body"></div>
                    </div>

                    <!-- 评论列表begin -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            共3条评论
                        </div>
                        <div class="panel-body">
                            <ul class="media-list">
                                <li class="media">
                                    <div class="media-left">
                                        <a href="#">
                                            <img class="media-object" src="../header.jpg" width="50" height="50">
                                        </a>
                                    </div>
                                    <div class="media-body">
                                        <div class="media-heading">刘英杰 评论于4天前</div>
                                        这是啥玩意啊，乱七八糟的
                                        <div class="media p3">
                                            <div class="media-left">
                                                <a href="#">
                                                    <img class="media-object" src="../header.jpg" width="50" height="50">
                                                </a>
                                            </div>

                                            <div class="media-body">
                                                <div class="media-heading">A 评论于3天前 <span class="pull-right"><a class="reply">回复</a></span>
                                                </div>
                                                这是啥玩意啊，乱七八糟的

                                                <div class="media p3">
                                                    <div class="media-left">
                                                        <a href="#">
                                                            <img class="media-object" src="../header.jpg" width="50" height="50">
                                                        </a>
                                                    </div>
                                                    <div class="media-body">
                                                        <div class="media-heading">B 评论于2天前</div>
                                                        支持楼上
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="media-footer">
                                            <a class="reply">回复</a>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- end -->

                    <!-- 评论begin -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            发表评论
                        </div>

                        <div class="panel-body">
                            <!--<form>-->
                                <!--<div class="form-group">-->
                                    <!--<label>留言:</label>-->
                                    <markDown></markDown>
                                <!--</div>-->
                                <button type="submit" class="btn btn-default">提交</button>
                            <!--</form>-->
                        </div>
                    </div>
                    <!--end-->
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <footerComponent></footerComponent>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    import markDown from '../markdown/Index';
    import footerComponent from '../footer/Index';
    import { Bus } from '../../api/bus.js';

    export default {
        components: {
            markDown,
            footerComponent
        },
        watch: {
            $route: {
                handler: function (val, oldVal) {
                    this.getPostInfo()
                }
            }
        },
        data() {
            return {
                post: '',
                error: '',
                context: 'aaaaaaaaaaaaaaaaaaaaaaaa',
                uid: 0
            }
        },
        mounted: function () {
            this.getPostInfo();
        },
        computed: {
            compiledMarkdown () {
                return marked(this.context, { sanitize: true })
            }
        },
        methods: {
            getPostInfo() {
                axios.get('api/post/' + this.$route.params.id)
                    .then(response => {
                        this.post = response.data;
                        this.context = response.data.body;
                        Bus.$emit('incrLook',this.post.id);
                        Bus.$emit('isLogin', uid => {
                            this.uid = uid;
                        });
                    })
                    .catch(err => {
                        console.log(err)
                    })
            },
            setData(err, {data: post}) {
                if (err) {
                    this.error = err.toString();
                } else {
                    this.post = post;
                }
            }
        }
    }
</script>

<style scoped>
    #detail {
        margin-top: 60px;
    }
    .badge-span {
        margin-right: 10px;
    }

    .p3 {
        border-top: rgba(0, 0, 0, 0.1) solid 1px;
        border-top-width: 1px;
        border-top-style: solid;
        border-top-color: rgba(0, 0, 0, 0.1);
        padding-top: 1rem !important;
    }
</style>