<template>
    <div class="form__container">
        <div class="form">
            <input-file @fileUploaded="storeData" :for="filed"></input-file>
            <submit-button @submited="submitForm" type="primary" text="Upload"></submit-button>
        </div>

    </div>
</template>

<script>
    import InputFile from "./InputFile";
    import SubmitButton from "./SubmitButton";

    export default {
        name: "FileUploader",

        data () {
            return {
                file : '',
            }
        },

        components: { InputFile , SubmitButton },

        props: ['filed'],

        methods: {
            submitForm() {
                let data = new FormData();
                data.append('image' , this.file);


                axios.post('/posts' , data)
                    .then(res => this.$emit('uploaded', res.data))
                    .catch(err => console.error(err));
            },

            storeData(file) {
                this.file = file;
            }
        }
    }
</script>

<style scoped>

</style>
