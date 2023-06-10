<template>
    <component
        :is="type === 'ordered' ? 'ol' : 'ul'"
        :class="[$style.UiEditorBlockList, { [$style['_ordered']]: type === 'ordered' }]"
    >
        <li
            v-for="(item, index) in list"
            :key="index"
            v-html="item"
        />
    </component>
</template>

<script setup>
const props = defineProps({
    list: {
        type: Array,
        default: () => ([])
    },

    type: {
        type: String,
        default: 'unordered'
    }
})
</script>

<style lang="sass" module>
.UiEditorBlockList
    padding-left: $offset-xs

    &._ordered
        li
            list-style-type: decimal

    li
        list-style-type: circle

        &:first-child
            margin-top: 5px

        &:not(:last-child)
            margin-bottom: $offset-xxs
</style>
