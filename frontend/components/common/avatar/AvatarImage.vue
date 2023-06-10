<template>
    <img
        v-if="path"
        :src="path"
        :class="[$style.avatar, { [$style['_rounded']]: rounded }]"
        alt="Avatar"
    >

    <img
        v-else
        src="~/assets/images/common/default-avatar.png"
        :class="[$style.avatar, { [$style['_rounded']]: rounded }]"
        alt="Avatar"
    >
</template>

<script setup>
const props = defineProps({
    path: {
        type: String,
        default: ''
    },

    rounded: {
        type: Boolean,
        default: true
    }
})
</script>

<style lang="sass" module>
.avatar
    display: block

    &._rounded
        border-radius: 50%
</style>
