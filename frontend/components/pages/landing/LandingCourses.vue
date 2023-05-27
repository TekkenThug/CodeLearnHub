<template>
    <section class="section">
        <div class="container">
            <h2 :class="$style.title">
                Курсы
            </h2>

            <ul :class="$style.courseList">
                <NuxtLink
                    v-for="course in [...courses, ...courses, ...courses]"
                    :key="course.title"
                    :to="course.link"
                    :class="$style.courseItem"
                >
                    <CourseCard v-bind="course" />
                </NuxtLink>
            </ul>
        </div>
    </section>
</template>

<script lang="ts" setup>
import CourseCard from '~/components/course/CourseCard.vue'

const courses = ref([{
    title: 'PHP',
    image: 'https://www.php.net/images/meta-image.png',
    lessonsCount: 14,
    studentsCount: 15672,
    link: '/courses'
}])
</script>

<style lang="sass" module>
.courseList
    display: flex
    flex-wrap: wrap
    gap: 24px

.courseItem
    @include trans
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
