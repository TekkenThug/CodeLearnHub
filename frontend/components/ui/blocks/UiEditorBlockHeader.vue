<template>
    <h3
        :class="$style.header"
        v-html="text"
    />
</template>

<script setup>
const props = defineProps({
    level: {
        type: Number,
        default: 1,
    },

    text: {
        type: String,
        default: ''
    }
})
</script>

<style lang="sass" module>
.header
    font-size: 21px
    color: $blue-dark-card
</style>
