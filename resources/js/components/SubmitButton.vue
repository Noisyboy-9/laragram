<template>
    <button type="submit" class="btn" @click="clicked" :class="style">{{ text }}</button>
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
        methods: {
          clicked() {
              this.$emit('submited');
          }
        },
        mounted() {
            this.style = 'btn--' + this.type
        }
    }
</script>

<style scoped>

</style>
