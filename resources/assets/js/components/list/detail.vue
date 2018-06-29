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
        <pageLink status="1" :prev="post.prev" :next="post.next" total="0"></pageLink>
    </div>
</template>

<script>
    import axios from 'axios'
    import pageLink from '../pageLink/Index'

    export default {
        components: {
            pageLink
        },
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
            }
        }
    }
</script>

<style scoped>
    .badge-span {
        margin-right: 10px;
    }
</style>