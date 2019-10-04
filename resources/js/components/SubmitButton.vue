<template>
    <button type="submit" class="btn" @click="emit('submited')" :class="style">{{ text }}</button>
</template>

<script>
    export default {
        name: "SubmitComponent",
        props: ['type' , 'text'],

        data() {
            return {
                style : '',
            }
        },

        mounted() {
            this.style = 'btn--' + this.type
        }
    }
</script>

<style scoped>

</style>
