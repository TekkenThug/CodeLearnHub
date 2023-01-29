<template>
  <div class="landing-entrance">
    <h2 class="landing-entrance__title" v-html="title" />

    <p v-if="subtitle" class="landing-entrance__subtitle">
      {{ props.subtitle }}
    </p>
  </div>
</template>

<script setup lang="ts">
const props = defineProps<{
  title: string
  subtitle?: string
}>()
</script>

<style lang="sass" scoped>
.landing-entrance
  margin-bottom: 50px

  &__title
    margin-bottom: 16px
    font-size: 48px
    line-height: 56px
    font-weight: 600

    & :deep(.blue)
      color: $second-primary-500

  &__subtitle
    font-size: 20px
    line-height: 28px
    color: $gray-500
</style>
