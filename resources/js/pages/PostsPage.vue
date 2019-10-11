`<template>
    <div>
        <file-uploader @uploaded="attachToPosts" :field="uploadTitle" ></file-uploader>


        <image-gallery :images="data"></image-gallery>
    </div>
</template>

<script>
    import FileUploader from '../components/FileUploader';
    import ImageGallery from "../components/ImageGallery";
    export default {
        name: "PostPage",

        components: { FileUploader, ImageGallery },

        props: ['uploadTitle' , 'posts'],

        data() {
          return {
              data : []
          }
        },

        mounted() {
            this.data = this.posts;
        },

        methods: {
            attachToPosts(post) {
                this.data.push(post);
            }
        },

    }
</script>

<style scoped>

</style>
`
