<template>
  <Splide class="landing-slider" :options="sliderOptions">
    <slot />
  </Splide>
</template>

<script setup lang="ts">
const sliderOptions = ref({
  type: 'loop',
  perPage: 3,
  gap: '24px',
  padding: '40px',
  pagination: true
})
</script>

<style lang="sass" scoped>
.landing-slider
  margin-bottom: 30px

  :deep(.splide__arrow)
    @include trans
    opacity: 1
    background-color: $white
    width: 40px
    height: 40px
    box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px

    svg
      @include trans

    &:hover
      background-color: $secondary-500

      svg
        fill: $white

  :deep(.splide__arrow--prev)
    left: -3px

  :deep(.splide__arrow--next)
    right: -3px

  :deep(.splide__pagination)
    bottom: -25px

  :deep(.splide__pagination__page)
    background-color: $gray-100

    &.is-active
      background-color: $secondary-500
</style>
