<template>
    <section class="section">
        <div class="container">
            <h2 :class="$style.subtitle">
                Описание
            </h2>

            <div
                v-html="description"
                :class="$style.description"
            />
        </div>
    </section>
</template>

<script lang="ts" setup>
const props = defineProps<{
    description: string
}>()
</script>

<style lang="sass" module>
.subtitle
    @include h2
    color: $blue-main
    margin-bottom: $offset-s

.description
    line-height: 24px
    max-width: 480px
</style>
