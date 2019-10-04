<template>
    <label :for="filed" @change="change" class="form__upload--label">
        +
        <input :name="filed" class="u-hidden" :id="filed" type="file">
    </label>
</template>

<script>
    export default {
        name: "InputFile",
        props: ['filed'],
        methods : {
            change(e) {
                this.$emit('fileUploaded', e.target.files[0]);
            }
        }
    }
</script>
