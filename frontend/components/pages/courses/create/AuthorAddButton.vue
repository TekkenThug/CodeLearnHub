<template>
    <div
        :class="$style.AuthorAddButton"
        @click="$emit('click')"
    >
        <Icon
            :class="$style.icon"
            name="bi:plus-circle-fill"
        />

        <span>{{ caption }}</span>
    </div>
</template>

<script lang="ts" setup>
const emit = defineEmits<{(e: 'click'): void }>()
const props = defineProps<{
    caption: string,
}>()
</script>

<style lang="sass" module>
.AuthorAddButton
    @include h3
    @include trans
    display: flex
    justify-content: center
    align-items: center
    color: $blue-main
    border: 2px dashed $blue-main
    padding: 16px 20px
    border-radius: $r-m
    user-select: none
    cursor: pointer

    @include hover
        border-color: $blue-dark
        color: $blue-dark

    span
        margin-left: $offset-m
</style>
