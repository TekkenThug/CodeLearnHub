<template>
  <div class="ui-input">
    <input
      :type="type"
      :placeholder="props.placeholder"
      :value="modelValue"
      :name="name"
      @input="$emit('update:modelValue', ($event.target as HTMLInputElement).value)"
    >

    <Transition name="fade">
      <span v-if="errorMessage" class="ui-input__error">
        {{ errorMessage }}
      </span>
    </Transition>
  </div>
</template>

<script setup lang="ts">
defineEmits(['update:modelValue'])

interface Props {
  name?: string,
  placeholder?: string
  type?: string
  modelValue?: string,
  errorMessage?: string,
  rules?: string[]
}

const props = withDefaults(defineProps<Props>(), {
  type: 'text',
  name: '',
  placeholder: '',
  modelValue: '',
  errorMessage: '',
  rules: () => ([])
})
</script>

<style lang="sass">
.ui-input

  input
    @include trans
    width: 100%
    display: block
    padding: 12px 16px
    border: 1px solid $gray-100
    border-radius: 10px
    background-color: $gray-50

    &:hover,
    &:focus
      background-color: $white
      box-shadow: rgba(0, 0, 0, 0.02) 0px 1px 3px 0px, rgba(27, 31, 35, 0.15) 0px 0px 0px 1px

    &:focus
      border-color: $second-primary-500

  &__error
    display: inline-block
    margin-top: 5px
    font-size: $font-body-tiny
    line-height: $lh-body-tiny
    color: $error-500
</style>
