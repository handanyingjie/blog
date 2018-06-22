<template>
    <div class="panel panel-default">
        <div class="panel-heading">
            {{ post.title }}
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

</style>