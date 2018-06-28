<template>
    <div>
        <div class="panel panel-default">
            <div class="panel-heading">
                {{ post.title }}
                <span class="pull-right">
                <span class="badge-span">
                    <i class="glyphicon glyphicon-eye-open"></i>
                    {{ post.looks }}
                </span>
                <time>
                    <i class="glyphicon glyphicon-time"></i>
                    {{ post.created_at }}
                </time>
            </span>
            </div>

            <div class="panel-body" v-html="post.body"></div>
        </div>
        <div class="row">
            <nav aria-label="...">
                <ul class="pager">
                    <li>
                        <router-link :to="{ path: '/detail/' + post.prev }">上一篇</router-link>
                    </li>
                    <li>
                        <router-link :to="{ path: '/detail/' + post.next }">下一篇</router-link>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</template>

<script>
    import axios from 'axios'

    export default {
        watch: {
            $route: {
                handler: function (val, oldVal) {
                    this.getPostInfo()
                }
            },
        },
        data() {
            return {
                post: '',
                error: ''
            }
        },
        mounted: function () {
            this.getPostInfo()
            this.notify()
        },
        methods: {
            getPostInfo() {
                axios.get('api/post/' + this.$route.params.id)
                    .then(response => {
                        this.post = response.data
                    })
                    .catch(err => {
                        console.log(err)
                    })
            },
            setData(err,{ data: post }){
                if(err){
                    this.error = err.toString();
                } else {
                    this.post = post;
                }
            },
            notify(){
                console.log('bbbb')
                this.$dispatch('pageView','aaaa')
            }
        }
    }
</script>

<style scoped>
    .badge-span {
        margin-right: 10px;
    }
</style>