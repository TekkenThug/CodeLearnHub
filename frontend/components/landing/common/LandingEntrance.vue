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
    font-size: $font-heading
    line-height: $lh-heading
    font-weight: 600

    & :deep(.blue)
      color: $second-primary-500

  &__subtitle
    font-size: $font-body-large
    line-height: $lh-body-large
    color: $gray-500
</style>
