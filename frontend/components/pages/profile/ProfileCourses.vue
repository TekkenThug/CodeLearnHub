<template>
    <div :class="$style.ProfileCourses">
        <div
            v-if="!courses || !courses.length"
            :class="$style.empty"
        >
            <slot />
        </div>

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
                :lessons-count="course.lessons_count"
                :students-count="course.students_count"
            />
        </NuxtLink>
    </div>
</template>

<script setup>
import CourseCard from '~/components/course/CourseCard'

const props = defineProps({
    courses: {
        type: Array,
        default: () => ([])
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
