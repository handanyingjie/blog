<template>
    <div>
        <mavonEditor :value="value" style="height: 100%"></mavonEditor>
    </div>
</template>
<script>
    import { mavonEditor } from 'mavon-editor'
    import 'mavon-editor/dist/css/index.css'

    export default {
        components: {
            mavonEditor
        },
        props: [
            'value'
        ],
        data() {
            return {
                value: ''
            }
        }
    }
</script>