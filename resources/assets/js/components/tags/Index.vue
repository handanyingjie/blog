<template>
    <div id="tag" class="panel panel-default">
        <div class="panel-heading">标签</div>
        <ul class="list-group">
            <router-link class="list-group-item" tag="li" v-for="(tag, index, key) of tags" :key="index" :to="{ path: '/', query: { tag: tag.id } }">
                <!--<a class="badge badge-pill badge-light border pull-left">{{ tag.name }} </a>-->
                <span class="badge badge-light border">{{ tag.number }}</span>
                <a>{{ tag.name }} </a>
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
    .badge {
        color: #6c757d;
        font-weight: normal;
        font-size: 12px;
        /*padding: 5px;*/
        /*margin-top: 12px;*/
    }
    .badge-light {
        background-color: #f8f9fa;
    }

    .border {
        border: 1px solid #dee2e6 !important;
    }
    /*.badge-light[href]:hover, .badge-light[href]:focus{*/
        /*color: #212529;*/
        /*text-decoration: none;*/
        /*background-color: #dae0e5;*/
    /*}*/
</style>