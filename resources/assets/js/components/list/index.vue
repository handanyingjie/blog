<template>
    <div id="list">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <!--<div class="row">-->
                        <div class="panel panel-default">
                            <div class="panel-heading">最新文章
                                <!--<router-link :to="{ path: '/posts' }" class="pull-right">更多</router-link>-->
                            </div>

                            <ul class="list-group">
                                <li class="list-group-item" v-for="(post, index) in posts" :key="index">
                                    <router-link :to="{ path: '/detail/'+ post.id }">
                                        {{ post.title }}
                                    </router-link>
                                    <span class="meta pull-right">
                                        {{ post.published_at }}
                                    </span>
                                </li>
                            </ul>
                        <!--</div>-->
                        <pageLink status="2" :total="total" :tag="tag" prev="" next=""></pageLink>
                    </div>
                </div>
                <div class="col-md-3">
                    <rightBox></rightBox>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <footerComponent></footerComponent>
        </div>
    </div>
</template>

<script>
    import {getPostList} from '../../api/api.js';
    import pageLink from '../pageLink/Index';
    import rightBox from  '../slideBar/Index';
    import footerComponent from '../footer/Index';
    import { Bus } from '../../api/bus.js';

    export default {
        components: {
            pageLink,
            rightBox,
            footerComponent
        },
        watch: {
            $route: {
                handler: function (val, oldVal) {
                    this.tag = val.query.tag ? val.query.tag : 0
                    this.getPosts()
                }
            },
        },
        data: function () {
            return {
                posts: '',
                total: 0,
                tag: 0,
                page: 1,
                limit: 1
            }
        },
        mounted() {
            this.getPosts()
        },
        methods: {
            getPosts: function () {
                var tag_id;
                if(this.tag) {
                    tag_id = this.tag
                } else {
                    tag_id = this.$route.query.tag ? this.$route.query.tag : 0
                }

                const page = this.$route.query.page ? this.$route.query.page : 1
                const limit = this.$route.query.limit ? this.$route.query.limit : 30
                getPostList(tag_id, page, limit )
                    .then(response => {
                        this.posts = response.data;
                        this.total = response.data.total;
                        Bus.$emit('isLogin',response.data.uid);
                    }).catch(err => {
                    console.log(err)
                })
            }
        }
    }
</script>

<style scoped>
    #list {
        margin-top: 60px;
    }
    .meta {
        font-size: 12px;
        color: #d0d0d0;
    }

    .meta a {
        text-decoration: none;
        color: #A9A9A9;
        font-size: 13px;
    }

    .meta a:hover, .meta a:focus {
        cursor: pointer;
        color: #d6514d;
    }

    .mi {
        min-width: 140px;
        text-overflow: ellipsis;
    }
</style>