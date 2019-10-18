`<template>
    <div>
        <file-uploader @uploaded="attachToPosts" :field="uploadTitle" ></file-uploader>


        <image-gallery @dataChanged="detachFromPosts" :images="data"></image-gallery>
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
            },

            detachFromPosts(post) {
                let newData = [];

                this.data.forEach(oldPost => {
                    if (oldPost.id !== post.id) {
                        newData.push(oldPost);
                    }
                });

                this.data = newData;
            }
        },


    }
</script>

<style scoped>

</style>

