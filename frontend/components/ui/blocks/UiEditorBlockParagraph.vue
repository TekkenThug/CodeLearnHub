<template>
    <p v-html="text" />
</template>

<script setup>
const props = defineProps({
    text: {
        type: String,
        default: ''
    }
})
</script>
