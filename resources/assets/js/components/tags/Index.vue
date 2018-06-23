<template>
    <div id="tag" class="panel panel-default">
        <div class="panel-heading">标签</div>
        <ul class="list-inline">
            <router-link tag="li" class="list-inline-item" v-for="(tag, index) of tags" :key="index" :to="{ path: '/', query: { tag: tag.id } }">
                <a class="badge badge-pill badge-light border pull-left">{{ tag.name }}</a>
            </router-link>
        </ul>
    </div>
</template>

<script>
    import { getTagList } from '../../api/api.js'

    export default {
        data: function () {
            return {
                tags: ''
            }
        },
        mounted() {
            this.getTags()
        },
        methods: {
            getTags: function () {
                getTagList()
                    .then( response => {
                        this.tags = response.data
                    } )
                    .catch( err => {
                        console.log(err)
                    } )
            }
        }
    }
</script>

<style scoped>
    .list-inline{
        padding: 12px 12px 0 12px;
    }
    .badge {
        color: #6c757d;
        font-weight: normal;
        font-size: 12px;
        padding: 5px;
        /*margin-top: 12px;*/
    }
    .badge-light {
        background-color: #f8f9fa;
    }

    .border {
        border: 1px solid #dee2e6 !important;
    }
    .badge-light[href]:hover, .badge-light[href]:focus{
        color: #212529;
        text-decoration: none;
        background-color: #dae0e5;
    }
</style>