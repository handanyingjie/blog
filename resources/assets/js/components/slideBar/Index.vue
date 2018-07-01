<template>
    <div>
        <people></people>
        <tags></tags>
        <rank></rank>
    </div>
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