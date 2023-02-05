<template>
  <button :class="['ui-button-light', `ui-button-light--${props.type}`]" @click="$emit('click')">
    <slot />
  </button>
</template>

<script setup lang="ts">
defineEmits(['click'])

interface Props {
  type?: 'primary'
}

const props = withDefaults(defineProps<Props>(), {
  type: 'primary'
})
</script>

<style lang="sass">
.ui-button-light
  position: relative
  padding: 4px 0

  &::before
    @include trans
    content: ''
    position: absolute
    bottom: 0
    left: 0
    width: 100%
    height: 1px
    opacity: 0
    background-color: transparent

  &:hover
    &::before
      opacity: 1

  &--primary
    color: $second-primary-500

    &::before
      background-color: $second-primary-500
</style>
