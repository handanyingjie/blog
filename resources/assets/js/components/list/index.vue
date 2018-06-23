<template>
    <div class="panel panel-default">
        <div class="panel-heading">最新文章
            <router-link :to="{ path: '/posts' }" class="pull-right">更多</router-link>
        </div>

        <ul class="list-group">
            <li class="list-group-item" v-for="(post, index) in posts" :key="index">
                <router-link :to="{ path: '/detail/'+ post.id }">
                    {{ post.title }}
                </router-link>
                <span class="pull-right">{{ post.created_at }}</span>
            </li>
        </ul>
    </div>
</template>

<script>
    import axios from 'axios'

    export default {
        data: function () {
            return {
                posts: ''
            }
        },
        mounted() {
            this.getPostsLists()
        },
        methods: {
            getPostsLists: function () {
                axios.get('api/posts')
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

</style>