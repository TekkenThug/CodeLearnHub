<template>
    <div :class="$style.UiTextarea">
        <span v-if="errorMessage" :class="$style.error">
            {{ errorMessage }}
        </span>

        <textarea
            :class="$style.textareaNative"
            :placeholder="placeholder"
            :disabled="disabled"
            :maxlength="maxLength"
            :value="modelValue"
            @input="$emit('update:modelValue', $event.target.value)"
        />
    </div>
</template>

<script lang="ts" setup>
defineEmits(['update:modelValue'])

interface Props {
    name?: string,
    placeholder?: string
    modelValue?: string,
    errorMessage?: string,
    disabled?: boolean,
    maxLength?: number,
}

const props = withDefaults(defineProps<Props>(), {
    name: '',
    placeholder: '',
    modelValue: '',
    errorMessage: '',
    disabled: false,
    maxLength: 2000
})
</script>

<style lang="sass" module>
.textareaNative
    @include trans
    width: 100%
    padding: 12px 16px
    border: 1px solid $gray-100
    border-radius: 10px
    background-color: $gray-50
    resize: none
    min-height: 200px

    &:hover,
    &:focus
        background-color: $white
        box-shadow: rgba(0, 0, 0, 0.02) 0px 1px 3px 0px, rgba(27, 31, 35, 0.15) 0px 0px 0px 1px

    &:focus
        border-color: $second-primary-500

    &:disabled
        pointer-events: none

.error
    display: inline-block
    margin-bottom: 5px
    font-size: $font-body-tiny
    line-height: $lh-body-tiny
    color: $error-500
</style>
