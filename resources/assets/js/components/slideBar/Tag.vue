<template>
    <div id="tag" ref="tags" :class="{ 'panel': true, 'panel-default': true }">
        <div class="panel-heading">标签</div>
        <ul class="list-group">
            <router-link class="list-group-item" tag="li" v-for="(tag, index, key) of tags" :key="index" :to="{ path: '/', query: { tag: tag.id } }">
                <!--<a class="badge badge-pill badge-light border pull-left">{{ tag.name }} </a>-->
                <span class="badge badge-light border">{{ tag.total }}</span>
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
                tags: '',
                box: null,
                fixed: false
            }
        },
        mounted() {
            this.getTags()
            // window.addEventListener('scroll', this.handleScroll)
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
            },
            // handleScroll: function(e){
            //     // console.log(e.target.documentElement.scrollTop)
            //     // console.log()
            //     // console.log(this.$refs.tags.offsetTop)
            //     if(e.target.documentElement.scrollTop >= this.$refs.tags.offsetTop){
            //         this.fixed = true
            //         // this.$refs.tags.addClass('sfixed')
            //     }
            // }
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