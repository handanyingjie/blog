<template>
    <div class="panel panel-default">
        <div class="panel-heading">阅读排行</div>
        <ul class="list-group">
            <router-link class="list-group-item" tag="li" v-for="(item, index, key) of rank" :key="index" :to="{ path: '/detail/' + item.id }">
                <!--<a class="badge badge-pill badge-light border pull-left">{{ tag.name }} </a>-->
                <span class="badge badge-light border">{{ item.looks }}</span>
                <a>{{ item.title }} </a>
            </router-link>
        </ul>
    </div>
</template>
<script>
    import { getRankList } from '../../api/api.js'
    export default {
        data: function(){
            return {
                rank: ''
            }
        },
        mounted(){
            this.getRank()
        },
        events: {
            'pageView': function (msg) {
                console.log(msg)
                this.getRank()
            }
        },
        methods: {
            getRank(){
                getRankList()
                    .then(response => {
                        this.rank = response.data
                    })
                    .catch(err => {
                        console.log(err)
                    })
            }
        }
    }
</script>
<style scoped>
    .badge {
        color: #6c757d;
        font-weight: normal;
        font-size: 12px;
    }
    .badge-light {
        background-color: #f8f9fa;
    }

    .border {
        border: 1px solid #dee2e6 !important;
    }
</style>