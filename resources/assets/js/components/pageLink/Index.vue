<template>
    <div>
        <nav v-if="status == 1" aria-label="..." class="center">
            <ul class="pager">
                <li>
                    <router-link :to="{ path: '/detail/' + prev }">上一篇</router-link>
                </li>
                <li>
                    <router-link :to="{ path: '/detail/' + next }">下一篇</router-link>
                </li>
            </ul>
        </nav>

        <nav v-if="pages > 1 && status == 2" aria-label="Page navigation" class="center">
            <ul class="pagination">
                <router-link tag="li" :to="{ path: '/', query: { page: prevClick, limit: pageSize,  tag: tag }}">
                    <a aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </router-link>
                <router-link v-for="(page, index) in pages" :key="index" tag="li" :to="{ path: '/', query: { page: page, limit: pageSize, tag: tag } }">
                    <a>{{ page }}</a>
                </router-link>
                <router-link tag="li" :to="{ path: '/', query: { page:nextClick, limit: pageSize,  tag: tag } }">
                    <a aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </router-link>
            </ul>
        </nav>
    </div>
</template>
<script>
    export default {
        props: [
            'status',
            'total',
            'prev',
            'next',
            'path',
            'tag'
        ],
        computed: {
            pages: function() {
                return Math.ceil(this.total / this.pageSize)
            },
            prevClick: function () {
                return this.curPage > 1 ? this.curPage - 1 : 1
            },
            nextClick: function () {
                return this.pages > this.curPage ? this.curPage + 1 : this.pages
            }
        },
        data: function () {
            return {
                pageSize: 20,
                curPage: 1
            }
        }
    }
</script>
<style rel="stylesheet/scss">
    .center {
        text-align: center;
    }
</style>