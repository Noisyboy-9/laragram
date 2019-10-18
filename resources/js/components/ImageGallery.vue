<template>
    <div class="gallery">
        <div v-for="image in images" class="gallery__container">
            <delete-button @deleted="deleteImage(image)"></delete-button>
            <img :src="'/storage/' + image.path" class="gallery__image" alt="Gallery Image">
        </div>
    </div>
</template>

<script>
    import deleteButton from "./deleteButton";
    export default {
        name: "ImageGallery",
        props: ['images'],
        components: { deleteButton },

        methods: {
            deleteImage(image) {
                const imageId = image.id;
                axios.delete('/posts/' + image.id)
                    .then(res => this.$emit('dataChanged', res.data))
                    .catch(err => console.error(err));
            }
        }
    }
</script>

