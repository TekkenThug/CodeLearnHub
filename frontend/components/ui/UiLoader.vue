<template>
    <span :class="['ui-loader', `ui-loader--${props.type}`]" />
</template>

<script setup lang="ts">
interface Props {
  type?: 'primary'
}

const props = withDefaults(defineProps<Props>(), {
    type: 'primary'
})
</script>

<style lang="sass">
.ui-loader
  width: 48px
  height: 48px
  border-width: 5px
  border-style: solid
  border-bottom-color: transparent
  border-radius: 50%
  display: inline-block
  box-sizing: border-box
  animation: rotation 1s linear infinite

  &--primary
    border-color: red
    border-bottom-color: transparent

  &--secondary
      border-color: $white
      border-bottom-color: transparent

@keyframes rotation
  0%
    transform: rotate(0deg)

  100%
    transform: rotate(360deg)
</style>
