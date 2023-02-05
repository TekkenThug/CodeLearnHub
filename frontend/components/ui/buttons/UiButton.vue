<template>
  <button
    :class="['ui-button', `ui-button--${props.type}`]"
    :disabled="disabled"
    @click="$emit('click')"
  >
    <slot />
  </button>
</template>

<script setup lang="ts">
defineEmits(['click'])

interface Props {
  type?: 'primary'
  disabled?: boolean
}

const props = withDefaults(defineProps<Props>(), {
  type: 'primary',
  disabled: false
})
</script>

<style lang="sass">
.ui-button
  @include trans
  font-weight: 500
  border-radius: 7px
  padding: 12px 24px

  &--primary
    color: $white
    background-color: $second-primary-500

    &:hover
      background-color: $second-primary-600

    &:disabled
      background-color: $second-primary-200
      cursor: not-allowed
</style>
