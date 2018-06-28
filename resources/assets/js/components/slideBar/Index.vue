<template>
    <aside class="col-md-3">
        <people></people>
        <tags></tags>
        <rank></rank>
    </aside>
</template>
<script>
    import people from './People'
    import tags from './Tag'
    import rank from './Rank'
    export default {
        components: {
            people, tags, rank
        }
    }
</script>