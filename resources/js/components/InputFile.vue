<template>
    <label :for="filed" class="form__upload--label">
        +
        <input :name="filed" class="u-hidden" :id="filed" type="file">
    </label>
</template>

<script>
    export default {
        name: "InputFile",
        props: ['filed']
    }
</script>
