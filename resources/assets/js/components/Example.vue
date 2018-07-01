<template>
    <div>
        <topNav></topNav>
        <!--<breadcrumb-nav></breadcrumb-nav>-->
        <router-view></router-view>
    </div>
</template>

<script>
    import topNav from "./nav/Index"
    export default {
        components: {
            topNav
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
<style scoped>
</style>
