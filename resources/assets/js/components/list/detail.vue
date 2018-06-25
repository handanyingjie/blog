<template>
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
</template>

<script>
    import axios from 'axios'

    export default {
        data() {
            return {
                post: ''
            }
        },
        mounted() {
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
            }
        }
    }
</script>

<style scoped>
    .badge-span {
        margin-right: 10px;
    }
</style>