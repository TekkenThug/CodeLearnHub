<template>
    <button
        :class="[
            'ui-button',
            `ui-button--${props.type}`,
            {
                'ui-button--is-loading': isLoading
            }
        ]"
        :disabled="disabled"
        @click="$emit('click')"
    >
        <Transition name="fade" :duration="100">
            <div v-if="isLoading" class="ui-button__loader">
                <UiLoader />
            </div>
        </Transition>

        <slot />
    </button>
</template>

<script setup lang="ts">
defineEmits(['click'])

interface Props {
  type?: 'primary' | 'danger'
  disabled?: boolean,
  isLoading?: boolean
}

const props = withDefaults(defineProps<Props>(), {
    type: 'primary',
    disabled: false,
    isLoading: false
})
</script>

<style lang="sass">
.ui-button
  @include trans
  position: relative
  font-weight: 500
  border-radius: 7px
  padding: 12px 24px
  overflow: hidden

  &:disabled
    cursor: not-allowed

  &--is-loading
    pointer-events: none

  &--primary
    color: $white
    background-color: $blue-main

    .ui-button__loader
      .ui-loader
        border-color: $white
        border-bottom-color: transparent

    &:hover
      background-color: $blue-dark-card

    &:disabled
      background-color: $second-primary-200

  &--danger
    color: $white
    background-color: $error-500

    @include hover
      background-color: darken($error-500, 10%)

  &__loader
    display: flex
    justify-content: center
    align-items: center
    position: absolute
    top: 0
    left: 0
    z-index: 1
    width: 100%
    height: 100%
    background-color: inherit
    pointer-events: none

    .ui-loader
      width: 24px
      height: 24px
      border-width: 2px
</style>
