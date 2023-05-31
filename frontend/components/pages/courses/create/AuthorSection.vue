<template>
    <div :class="$style.AuthorSection">
        <h2 :class="$style.title">
            {{ title }}
        </h2>

        <p :class="$style.description">
            <slot name="description" />
        </p>

        <div>
            <slot />
        </div>
    </div>
</template>

<script lang="ts" setup>
const props = defineProps<{
    title: string
}>()
</script>

<style lang="sass" module>
.title
    @include h2
    margin-bottom: $offset-s
    color: $blue-dark-card

.description
    @include p2
    line-height: 26px
    max-width: 580px
    margin-bottom: $offset-l
</style>
