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
                <div class="panel panel-default" v-if="replyLength > 0">
                    <div class="panel-heading">
                        共{{replyLength}}条评论
                    </div>
                    <div class="panel-body">
                        <ul class="media-list">
                            <li class="media" v-for="(reply,index) in rr" :key="'reply'+ index">
                                <div class="media-left">
                                    <a href="#">
                                        <img class="media-object" src="../header.jpg" width="50" height="50">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <div class="media-heading">{{ reply.nickname }} 评论于{{ reply.created_at }}</div>
                                    <p>{{ reply.body }}</p>
                                    <!--<div class="media p3">-->
                                        <!--<div class="media-left">-->
                                            <!--<a href="#">-->
                                                <!--<img class="media-object" src="../header.jpg" width="50"-->
                                                     <!--height="50">-->
                                            <!--</a>-->
                                        <!--</div>-->

                                        <!--<div class="media-body">-->
                                            <!--<div class="media-heading">A 评论于3天前 <span class="pull-right"><a-->
                                                    <!--class="reply">回复</a></span>-->
                                            <!--</div>-->
                                            <!--这是啥玩意啊，乱七八糟的-->

                                            <!--<div class="media p3">-->
                                                <!--<div class="media-left">-->
                                                    <!--<a href="#">-->
                                                        <!--<img class="media-object" src="../header.jpg" width="50"-->
                                                             <!--height="50">-->
                                                    <!--</a>-->
                                                <!--</div>-->
                                                <!--<div class="media-body">-->
                                                    <!--<div class="media-heading">B 评论于2天前</div><span class="pull-right"><a-->
                                                        <!--class="reply">回复</a></span>-->
                                                    <!--支持楼上-->
                                                <!--</div>-->
                                            <!--</div>-->
                                        <!--</div>-->
                                    <!--</div>-->
                                    <div class="media-footer">
                                        <a class="reply" @click="subReplyClick(index,reply.nickname)">回复</a>
                                    </div>
                                    <div ref="subReply" :key="'sub_reply_' + index" class="sub-reply">
                                        <div class="form-group">
                                            <textarea class="form-control" @input="subReply"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-sm btn-primary" @click="save()">回复</button>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                 <!--end-->

                 <!--评论begin-->
                <div class="panel panel-default">
                    <!--<div class="panel-heading">-->

                    <!--</div>-->

                    <div class="panel-body">
                        <!--<form>-->
                        <!--<div class="form-group">-->
                        <!--<label>留言:</label>-->
                        <!--<markDown></markDown>-->
                        <mavonEditor :value="value" style="height: 100%" @change="reply()"></mavonEditor>
                        <!--</div>-->
                        <button type="submit" class="btn btn-default" @click="save()">提交</button>
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
    // import markDown from '../markdown/Index';
    import footerComponent from '../footer/Index';
    import {Bus} from '../../api/bus.js';
    import { mavonEditor } from 'mavon-editor';
    import 'mavon-editor/dist/css/index.css';
    import {createReply,getRelies} from '../../api/api.js';

    export default {
        components: {
            // markDown,
            mavonEditor,
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
                uid: 0,
                replies: {
                    nickname: '',
                    body: '',
                    post_id: 0
                },
                value: '',
                rr: ''
            }
        },
        mounted: function () {
            this.getPostInfo();
            this.getR();
        },
        computed: {
            compiledMarkdown() {
                return marked(this.context, {sanitize: true})
            },
            replyLength(){
                return this.rr.length;
            }
        },
        methods: {
            getPostInfo() {
                axios.get('api/post/' + this.$route.params.id)
                    .then(response => {
                        this.post = response.data;
                        this.context = response.data.body;
                        Bus.$emit('incrLook', this.post.id);
                        Bus.$emit('isLogin', uid => {
                            this.uid = uid;
                        });
                    })
                    .catch(err => {
                        console.log(err)
                    })
            },
            getR(){
                getRelies(this.$route.params.id).then(response => {
                    this.rr = response.data;
                }).catch(err => {
                    console.log(err);
                });
            }
            ,
            setData(err, {data: post}) {
                if (err) {
                    this.error = err.toString();
                } else {
                    this.post = post;
                }
            },
            save() {
                this.replies.nickname = prompt("请输入昵称","匿名用户");
                this.replies.post_id = this.post.id;
                createReply(this.replies).then(response => {
                    if (response.data.status == 200) {
                        this.getR();
                        this.$refs.subReply.forEach(function (elem) {
                            elem.children[0].children[0].value = "";
                            elem.style.display = 'none';
                        });
                        return
                    }
                    alert(response.data.message)
                }).catch( err => {} );
            },
            reply(val){
                console.log(val);
                this.replies.body = val;
            },
            subReply(event){
                this.replies.body = event.target.value;
            },
            subReplyClick: function(i,nickname){
                this.$refs.subReply.forEach(function (elem) {
                    elem.style.display = 'none';
                    elem.children[0].children[0].value = "";
                });
                this.$refs.subReply[i].children[0].children[0].value = "@"+nickname + " ";
                this.$refs.subReply[i].style.display = 'block';
                this.$refs.subReply[i].children[0].children[0].style.autofocus = true;
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
    .media-footer{
        margin: 8px 0px;
    }
    .media-footer a {
        cursor: pointer;
        color: gray;
    }
    .media-body p {
        padding: 4px;
    }
    .sub-reply {
        display: none;
    }
</style>