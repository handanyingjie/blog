<template>
    <div>
        <topNav></topNav>
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <!--<breadcrumb-nav></breadcrumb-nav>-->
                    <router-view></router-view>
                </div>
                <rightBox></rightBox>
            </div>
        </div>
        <footerComponent></footerComponent>
    </div>
</template>

<script>
    import topNav from "./nav/Index"
    import rightBox from  './slideBar/Index'
    import footerComponent from './footer/Index'
    import tag from './slideBar/Tag'
    export default {
        components: {
            topNav, rightBox, footerComponent, tag
        },
        data: function () {
            return {

            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
<style scoped>
    .container {
        margin-top: 60px;
    }
</style>
