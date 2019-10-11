<template>
    <div class="gallery">
        <div v-for="image in images" class="gallery__container">
            <img :src="'/storage/' + image.path" class="gallery__image" alt="Gallery Image">
        </div>
    </div>
</template>

<script>
    export default {
        name: "ImageGallery",
        props: ['images']
    }
</script>

<style scoped>

</style>
