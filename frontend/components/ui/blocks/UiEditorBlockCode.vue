<template>
    <code
        :class="$style.header"
        v-html="code"
    />
</template>

<script setup>
const props = defineProps({
    code: {
        type: String,
        default: ''
    },
})
</script>

<style lang="sass" module>
.UiEditorBlockCode
    padding: $offset-xs $offset-s
    background-color: $gray-50
    color: #000000
    font-size: 14px
</style>
