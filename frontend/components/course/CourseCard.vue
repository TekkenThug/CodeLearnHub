<template>
    <div :class="$style.CourseCard">
        <div :class="$style.image">
            <img :src="image" alt="">
        </div>

        <div :class="$style.info">
            <h3 :class="$style.title">
                {{ title }}
            </h3>

            <div :class="$style.statistic">
                <strong :class="$style.statisticItem">
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
    lessonsCount: number,
    studentsCount?: number
}

const props = defineProps<CourseCard>()

const lessonPluralize = computed(() => {
    return `${props.lessonsCount} ${pluralize(props.lessonsCount, ['урок', 'урока', 'уроков'])}`
})
const studentPluralize = computed(() => {
    if (!props.studentsCount) { return '' }

    return `${props.studentsCount} ${pluralize(props.studentsCount, ['студент', 'студента', 'студентов'])}`
})
</script>

<style lang="sass" module>
.CourseCard
    background-color: $white
    border-radius: $r-l
    overflow: hidden
    box-shadow: 0 0 15px rgba(48, 175, 255, 0.2)

.image
    height: 200px

    & > img
        width: 100%
        height: 100%
        object-fit: cover
        object-position: center

.info
    border: 1px solid $blue-main
    border-top: none
    border-bottom-right-radius: $r-l
    border-bottom-left-radius: $r-l
    padding: $offset-m

.title
    @include p1
    font-weight: 700
    margin-bottom: $offset-xs

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
