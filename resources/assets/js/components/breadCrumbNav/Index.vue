<template>
    <div class="row">
        <ol class="breadcrumb">
            <li>
                <router-link :to="{ path: '/' }">首页</router-link>
            </li>
            <!--<li><a href="#">Library</a></li>-->
            <!--<li class="active">Data</li>-->
        </ol>
    </div>
</template>
<script>
    export default {
        props: {
            breadCrumbNav: Array
        },
        mounted() {
            console.log('breadcrumb')
        }
    }
</script>