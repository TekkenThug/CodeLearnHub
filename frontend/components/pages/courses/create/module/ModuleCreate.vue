<template>
    <div :class="$style.ModuleCreate">
        <strong :class="$style.order">{{ order }}.</strong>

        <UiInput
            v-model="localValue.title"
            placeholder="Название"
            :class="$style.titleField"
        />

        <Controls
            @delete="$emit('delete')"
            @top="$emit('top')"
            @bottom="$emit('bottom')"
        />

        <div :class="$style.lessonList">
            <h3 :class="$style.lessonListTitle">
                Уроки:
            </h3>

            <transition-group name="fade" mode="out-in">
                <LessonCreate
                    v-for="(lesson, index) in localValue.lessons"
                    :key="lesson.id"
                    v-model="localValue.lessons[index]"
                    :order="localValue.lessons.findIndex(item => item.id === lesson.id) + 1"
                    :parent-order="order"
                    :class="$style.lesson"
                    @delete="deleteLesson(lesson.id)"
                    @top="move(lesson.id, 'top')"
                    @bottom="move(lesson.id, 'bottom')"
                />
            </transition-group>

            <AuthorAddButton
                caption="Добавить урок"
                @click="addLesson"
            />
        </div>
    </div>
</template>

<script lang="ts" setup>
import AuthorAddButton from '~/components/pages/courses/create/AuthorAddButton.vue'
import LessonCreate from '~/components/pages/courses/create/module/LessonCreate.vue'
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
    modelValue: any,
}>()

const localValue = computed({
    get() {
        return props.modelValue
    },

    set(newValue) {
        emit('update:modelValue', newValue)
    }
})

const addLesson = () => {
    localValue.value.lessons.push({
        id: localValue.value.lessons.length,
        name: '',
        content: '',
        layout_code: '',
        test_code: ''
    })
}
const deleteLesson = (id: number) => {
    localValue.value.lessons = localValue.value.lessons.filter(item => item.id !== id)
}
const move = (id: number, direction: string) => {
    const index = localValue.value.lessons.findIndex(item => item.id === id)
    const indexOfTop = direction === 'top' ? index - 1 : index + 1

    if (index < 0 || index >= localValue.value.lessons.length || indexOfTop < 0 || indexOfTop >= localValue.value.lessons.length) {
        return
    }

    const temp = localValue.value.lessons[index]
    localValue.value.lessons[index] = localValue.value.lessons[indexOfTop]
    localValue.value.lessons[indexOfTop] = temp
}
</script>

<style lang="sass" module>
.ModuleCreate
    display: flex
    align-items: center
    flex-wrap: wrap

.order
    @include h3
    color: $blue-main
    width: 20px
    margin-right: $offset-xxs
    flex-shrink: 0

.titleField
    flex-grow: 1

.lessonList
    padding-top: $offset-m
    width: 92%
    margin: 0 auto

.lessonListTitle
    @include h3
    color: $blue-main
    margin-bottom: $offset-xxs

.lesson
    padding: $offset-s
    border: 2px solid $blue-main
    border-radius: $r-m
    margin-bottom: $offset-s
</style>
