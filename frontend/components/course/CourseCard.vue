<template>
    <div :class="$style.CourseCard">
        <div :class="$style.image">
            <img :src="image" alt="">
        </div>

        <div :class="$style.info">
            <div :class="$style.top">
                <h3 :class="$style.title">
                    {{ title }}
                </h3>

                <div
                    v-if="showProgress"
                    :class="$style.progress"
                >
                    {{ progressOnCourse }} %

                    <div :class="$style.progressBar">
                        <span
                            :style="{ width: `${progressOnCourse}%` }"
                            :class="$style.progressBarFill"
                        />
                    </div>
                </div>
            </div>

            <p :class="$style.description">
                {{ description }}
            </p>

            <div :class="$style.statistic">
                <strong v-if="lessonsCount" :class="$style.statisticItem">
                    <Icon
                        name="bi:book"
                        size="16"
                        :class="$style.statisticIcon"
                    />
                    <span>{{ lessonPluralize }}</span>
                </strong>

                <strong v-if="studentsCount" :class="$style.statisticItem">
                    <Icon
                        name="bi:people-fill"
                        size="16"
                        :class="$style.statisticIcon"
                    />
                    <span>{{ studentPluralize }}</span>
                </strong>
            </div>
        </div>
    </div>
</template>

<script lang="ts" setup>
import { pluralize } from '~/utils/string'

interface CourseCard {
    image: string,
    title: string,
    description?: string,
    lessonsCount?: number,
    studentsCount?: number,
    progressCount?: number,
}

interface Additional {
    showProgress?: boolean
}

interface Props extends CourseCard, Additional {}

const props = defineProps<Props>()

const lessonPluralize = computed(() => {
    if (!props.lessonsCount) { return '' }

    return `${props.lessonsCount} ${pluralize(props.lessonsCount, ['урок', 'урока', 'уроков'])}`
})
const studentPluralize = computed(() => {
    if (!props.studentsCount) { return '' }

    return `${props.studentsCount} ${pluralize(props.studentsCount, ['студент', 'студента', 'студентов'])}`
})

const progressOnCourse = computed(() => {
    if (!props.lessonsCount || typeof props.progressCount !== 'number') {
        return ''
    }

    return Math.round(props.progressCount * 100)
})
</script>

<style lang="sass" module>
.CourseCard
    display: flex
    flex-direction: column
    background-color: $white
    border-radius: $r-l
    overflow: hidden
    box-shadow: 0 0 15px rgba(48, 175, 255, 0.2)
    border: 1px solid $blue-main

.image
    height: 200px

    & > img
        width: 100%
        height: 100%
        object-fit: cover
        object-position: center

.info
    border-bottom-right-radius: $r-l
    border-bottom-left-radius: $r-l
    padding: $offset-m
    flex-grow: 1

.top
    display: flex
    justify-content: space-between
    align-items: center
    margin-bottom: $offset-xs

.title
    @include p1
    font-weight: 700

.description
    @include p2
    margin-bottom: $offset-xs
    display: -webkit-box /* Добавление вендорного префикса для поддержки браузерами */
    -webkit-box-orient: vertical /* Установка вертикальной ориентации блока */
    -webkit-line-clamp: 2 /* Ограничение количества отображаемых строк */
    overflow: hidden /* Скрытие текста, выходящего за пределы блока */
    text-overflow: ellipsis /* Добавление многоточия в конце текста */

.progress
    @include h3
    display: flex
    flex-direction: column
    align-items: center
    color: $blue-dark-card

.progressBar
    position: relative
    background-color: $blue-main
    height: 4px
    width: 75px
    border-radius: 4px
    overflow: hidden

.progressBarFill
    position: absolute
    background-color: $blue-dark-card
    height: 100%
    top: 0
    left: 0

.statistic
    display: flex
    justify-content: space-between
    align-items: center

.statisticIcon
    width: 16px
    height: 16px
    margin-right: 8px

.statisticItem
    display: flex
    align-items: center
    flex-shrink: 0
    font-weight: 500
    @include p3
</style>
