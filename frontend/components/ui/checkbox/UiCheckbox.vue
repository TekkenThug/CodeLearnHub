<template>
    <label :class="$style.UiCheckbox">
        <input
            :class="[$style.checkbox, { [$style['_offset-top']]: $slots.default }]"
            :value="modelValue"
            :true-value="true"
            :false-value="false"
            type="checkbox"
            @change="$emit('update:modelValue', $event.target.checked)"
        >

        <span
            v-if="$slots.default"
            :class="$style.caption"
        >
            <slot />
        </span>
    </label>
</template>

<script setup>
defineEmits(['update:modelValue'])

const props = defineProps({
    modelValue: {
        type: Boolean,
        default: false
    }
})
</script>

<style lang="sass" module>
.UiCheckbox
    display: flex
    align-items: flex-start
    cursor: pointer

.checkbox
    flex-shrink: 0

    &._offset-top
        margin-top: 2px

.caption
    margin-left: 10px
    font-size: 12px
    line-height: 16px
    user-select: none
</style>
