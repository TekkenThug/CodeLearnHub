<template>
    <div :class="$style.ProfileCourses">
        <div
            v-if="!courses || !courses.length"
            :class="$style.empty"
        >
            <slot />
        </div>

        <div v-else :class="$style.courseList">
            <NuxtLink
                v-for="course in courses"
                :key="course.id"
                :to="`/courses/${course.id}`"
                :class="$style.courseLink"
            >
                <CourseCard
                    :class="$style.course"
                    :image="course.cover"
                    :title="course.name"
                    :description="course.description"
                    :progress-count="course.progress"
                    :show-progress="showProgress"
                    :lessons-count="course.lessons_count"
                    :students-count="course.students_count"
                />
            </NuxtLink>
        </div>
    </div>
</template>

<script setup>
import CourseCard from '~/components/course/CourseCard'

const props = defineProps({
    courses: {
        type: Array,
        default: () => ([])
    },

    showProgress: {
        type: Boolean,
        default: false
    }
})
</script>

<style lang="sass" module>
.ProfileCourses
    display: flex
    flex-wrap: wrap

.empty
    display: flex
    flex-direction: column
    align-items: flex-start
    gap: $offset-xs

.courseList
    width: 100%
    display: flex
    flex-wrap: wrap
    gap: 24px

.courseLink
    @include trans
    display: flex
    align-items: stretch
    justify-content: stretch
    width: calc((100% - 24px * 2) / 3)
    cursor: pointer

    @include responsive($tablet)
        width: calc((100% - 24px * 2) / 2)

    @include responsive($mobile)
        width: 100%

    @include hover
        transform: scale(1.02)

.course
    width: 100%
</style>
