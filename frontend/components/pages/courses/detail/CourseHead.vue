<template>
    <section
        :class="$style.firstSection"
        :style="{ backgroundImage: `url('${course.cover}')` }"
    >
        <div :class="[$style.wrapper, 'container']">
            <div>
                <h1
                    v-if="course.name"
                    :class="$style.title"
                >
                    {{ course.name }}
                </h1>

                <div :class="$style.property">
                    Рейтинг: {{ course.rate }} / 5
                </div>

                <div :class="$style.property">
                    Студентов на курсе: {{ course.students_count }}
                </div>

                <div :class="$style.property">
                    Количество уроков: {{ course.lessons_count }}
                </div>
            </div>

            <UiButton
                v-if="enabledButton"
                @click="$emit('start')"
            >
                Начать
            </UiButton>
        </div>
    </section>
</template>

<script lang="ts" setup>
import UiButton from '~/components/ui/buttons/UiButton.vue'

const emits = defineEmits<{ (e: 'start') }>()
const props = defineProps<{
    course: object,
    enabledButton: boolean,
}>()
</script>

<style lang="sass" module>
.firstSection
    position: relative
    display: flex
    align-items: flex-end
    min-height: 320px
    padding: $offset-l 0
    background-repeat: no-repeat
    background-size: cover
    background-position: center center

    &:before
        content: ""
        position: absolute
        top: 0
        left: 0
        width: 100%
        height: 100%
        background-color: rgba(#000, .5)
        z-index: 0

.wrapper
    display: flex
    justify-content: space-between
    align-items: flex-end
    position: relative
    z-index: 1
    color: $white

    @include responsive($mobile)
        flex-direction: column
        align-items: flex-start

.title
    @include h1
    margin-bottom: $offset-l

.property
    @include h3
    font-weight: 500
    margin-bottom: $offset-xxs
</style>
