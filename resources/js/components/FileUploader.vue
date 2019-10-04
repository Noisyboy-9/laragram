<template>
    <div class="form__container">
        <div class="form">
            <input-file :for="filed"></input-file>
            <submit-button @submited="submitForm" type="primary" text="Upload"></submit-button>
        </div>

    </div>
</template>

<script>
    import InputFile from "./InputFile";
    import SubmitButton from "./SubmitButton";

    export default {
        name: "FileUploader",

        components: { InputFile , SubmitButton },

        props: ['filed'],

        methods: {

        }
    }
</script>

<style scoped>

</style>
