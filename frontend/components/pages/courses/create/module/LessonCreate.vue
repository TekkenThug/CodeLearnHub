<template>
    <div>
        <div :class="$style.top">
            <strong :class="$style.title">
                {{ caption }}
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

        <UiEditor
            placeholder="Содержимое"
            :class="$style.field"
            @change="edit => value.content = !edit.length ? '' : JSON.stringify(edit)"
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

<script setup>
import Controls from '~/components/pages/courses/create/module/Controls'
import UiEditor from '~/components/ui/UiEditor'

const emit = defineEmits(['delete', 'top', 'bottom', 'update:modelValue'])
const props = defineProps({
    order: {
        type: Number,
        required: true
    },

    parentOrder: {
        type: Number,
        required: true
    },

    modelValue: {
        type: Object,
        required: true
    }
})

const caption = computed(() => `${props.parentOrder}.${props.order}.`)
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
