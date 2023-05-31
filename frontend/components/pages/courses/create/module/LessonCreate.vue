<template>
    <div>
        <div :class="$style.top">
            <strong :class="$style.title">
                {{ parentOrder }}.{{ order }}.
            </strong>

            <div>
                <Controls
                    @delete="$emit('delete')"
                    @top="$emit('top')"
                    @bottom="$emit('bottom')"
                />
            </div>
        </div>

        <UiInput
            v-model="value.name"
            placeholder="Название"
            :class="$style.field"
        />

        <UiTextarea
            v-model="value.content"
            placeholder="Содержимое"
            :class="$style.field"
        />

        <UiTextarea
            v-model="value.test_code"
            placeholder="Тестовый код. Выполняется на сервере для проверки задания"
            :class="$style.field"
        />

        <UiTextarea
            v-model="value.layout_code"
            placeholder="Шаблонный код. С ним ученик начинает урок"
            :class="$style.field"
        />
    </div>
</template>

<script lang="ts" setup>
import Controls from '~/components/pages/courses/create/module/Controls.vue'

// eslint-disable-next-line func-call-spacing
const emit = defineEmits<{
    (e: 'delete'): void,
    (e: 'top'): void,
    (e: 'bottom'): void,
    (e: 'update:modelValue', value: object): void
}>()
const props = defineProps<{
    order: number,
    parentOrder: number,
    modelValue: any,
}>()

const value = computed({
    get() {
        return props.modelValue
    },

    set(newValue) {
        emit('update:modelValue', newValue)
    }
})
</script>

<style lang="sass" module>
.top
    display: flex
    justify-content: space-between
    align-items: center

.title
    @include h3
    display: inline-block
    color: $blue-main
    width: 20px
    margin-right: $offset-xxs
    margin-bottom: $offset-xxs
    flex-shrink: 0

.field
    &:not(:last-child)
        margin-bottom: $offset-xs
</style>
