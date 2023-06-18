<template>
    <code
        :class="$style.UiEditorBlockCode"
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
    width: 100%
    padding: $offset-xs $offset-s
    background-color: $gray-50
    color: #000000
    font-size: 14px
</style>
