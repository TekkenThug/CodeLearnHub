<template>
    <section class="section">
        <div class="container">
            <h2 :class="$style.title">
                Курсы
            </h2>

            <ul :class="$style.courseList">
                <NuxtLink
                    v-for="course in courses"
                    :key="course.id"
                    :to="`/courses/${course.id}`"
                    :class="$style.courseItem"
                >
                    <CourseCard
                        :image="course.cover"
                        :title="course.name"
                        :description="course.description"
                        :lessons-count="course.lessons_count"
                        :students-count="course.students_count"
                        v-bind="course"
                    />
                </NuxtLink>
            </ul>
        </div>
    </section>
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
.courseList
    display: flex
    flex-wrap: wrap
    gap: 24px

.courseItem
    @include trans
    display: flex
    justify-content: stretch
    width: calc((100% - 24px * 2) / 3)

    @include responsive($tablet)
        width: calc((100% - 24px * 2) / 2)

    @include responsive($mobile)
        width: 100%

    @include hover
        transform: scale(1.02)

.title
    @include h1
    margin-bottom: $offset-m
    color: $blue-main
</style>
