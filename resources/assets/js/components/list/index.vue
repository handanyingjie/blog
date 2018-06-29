<template>
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">最新文章
                <router-link :to="{ path: '/posts' }" class="pull-right">更多</router-link>
            </div>

            <ul class="list-group">
                <li class="list-group-item" v-for="(post, index) in posts" :key="index">
                    <router-link :to="{ path: '/detail/'+ post.id }">
                        {{ post.title }}
                    </router-link>
                    <span class="meta pull-right">
                        <!--<router-link  v-for="(tag, index) in post.tags" :key="'tag_'+ index" :to="{ path: '/' , query: { tag: tag.id }}" :title="tag.slug">{{ tag.name }}</router-link>-->
                        <!--<span> ⋅ </span>-->
                        <!--12 点赞-->
                        <!--<span> ⋅ </span>-->
                        <!--0 回复-->
                        <!--<span> ⋅ </span>-->
                        <!--<span class="time">-->
                            {{ post.created_at }}
                        <!--</span>-->
                    </span>
                </li>
            </ul>
        </div>
        <pageLink status="2" :total="total" :tag="tag" prev="" next=""></pageLink>
        </div>
</template>

<script>
    import {getPostList} from '../../api/api.js'
    import pageLink from '../pageLink/Index'

    export default {
        components: {
            pageLink
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
                const limit = this.$route.query.limit ? this.$route.query.limit : 20
                getPostList(tag_id, page, limit )
                    .then(response => {
                        this.posts = response.data.posts
                        this.total = response.data.total;
                    }).catch(err => {
                    console.log(err)
                })
            }
        }
    }
</script>

<style scoped>
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
</style>