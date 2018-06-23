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
                        <router-link  v-for="(tag, index) in post.tags" :key="'tag_'+ index" :to="{ path: '/' , query: { tag: tag.id }}" :title="tag.slug">{{ tag.name }}</router-link>
                        <span> ⋅ </span>
                        12 点赞
                        <span> ⋅ </span>
                        0 回复
                        <span> ⋅ </span>
                        <span class="time">
                            {{ post.created_at }}
                        </span>
                    </span>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    import axios from 'axios'

    export default {
        watch: {
            // $route(to, from) {
            //     console.log(to)
            //     console.log(from)
            // },
            $route: {
                handler: function (val, oldVal) {
                    console.info(val)
                    console.info(oldVal)
                    this.getPostsList()
                }
            },
        },
        data: function () {
            return {
                posts: ''
            }
        },
        mounted() {
            this.getPostsList()
        },
        methods: {
            getPostsList: function () {
                const tag_id = this.$route.query.tag ? this.$route.query.tag : 0
                axios.get('api/posts/'+ tag_id)
                    .then(response => {
                        this.posts = response.data
                    }).catch(err => {
                    console.log(err)
                })
            }
        }
    }
</script>

<style scoped>
    .meta{
        font-size: 12px;
        color: #d0d0d0;
    }
    .meta a{
        text-decoration: none;
        color: #A9A9A9;
        font-size: 13px;
    }

    .meta a:hover, .meta a:focus {
        cursor: pointer;
        color: #d6514d;
    }
</style>