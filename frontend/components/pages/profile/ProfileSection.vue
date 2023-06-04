<template>
    <section>
        <h2 :class="$style.title">
            {{ title }}
        </h2>

        <slot />
    </section>
</template>

<script lang="ts" setup>
const props = defineProps<{
    title: string
}>()
</script>

<style lang="sass" module>
.title
    @include h2
    color: $blue-main
    margin-bottom: $offset-m
</style>
