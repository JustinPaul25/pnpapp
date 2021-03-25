<template>
    <div>
        <!-- SOURCE -->
        <div id="printMe">
        <h1>Print me!</h1>
        </div>
        <!-- OUTPUT -->
        <button @click="print">Print</button>
    </div>
</template>

<script>
    export default {
        data () {
            return {
            output: null
            }
        },
        methods: {
            print () {
            // Pass the element id here
            this.$htmlToPaper('printMe');
            }
        }
    }
</script>