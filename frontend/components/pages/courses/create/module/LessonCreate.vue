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
            placeholder="Методическая часть урока"
            :class="$style.field"
            @change="edit => value.content = !edit.length ? '' : JSON.stringify(edit)"
        />

        <CodeEditor
            :class="$style.field"
            prepared-code="// Тестовый код. Выполняется на сервере для проверки задания"
            @change="code => value.test_code = code"
        />

        <CodeEditor
            :class="$style.field"
            prepared-code="// Шаблонный код. С ним ученик начинает урок"
            @change="code => value.layout_code = code"
        />
    </div>
</template>

<script setup>
import Controls from '~/components/pages/courses/create/module/Controls'
import UiEditor from '~/components/ui/UiEditor'
import CodeEditor from '~/components/common/code-editor/CodeEditor'

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
