<template>
    <div :class="$style.CourseList">
        <div class="container">
            <div :class="$style.wrapper">
                <transition name="fade" mode="out-in">
                    <div
                        v-if="isLoading"
                        :class="$style.loaderContainer"
                        key="loader"
                    >
                        <UiLoader
                            key="loader"
                        />
                    </div>

                    <div
                        v-else-if="courses.length"
                        key="content"
                        :class="$style.list"
                    >
                        <NuxtLink
                            v-for="course in courses"
                            :key="course.title"
                            :to="`/courses/${course.id}`"
                            :class="$style.courseLink"
                        >
                            <CourseCard
                                :class="$style.courseItem"
                                :image="course.cover"
                                :title="course.name"
                                :description="course.description"
                                :lessons-count="course.lessons_count"
                                :students-count="course.students_count"
                                v-bind="course"
                            />
                        </NuxtLink>
                    </div>

                    <strong
                        v-else
                        key="empty"
                        :class="$style.emptyTitle"
                    >
                        Курсов не найдено
                    </strong>
                </transition>
            </div>
        </div>
    </div>
</template>

<script lang="ts" setup>
import CourseCard from '~/components/course/CourseCard.vue'

interface Props {
    isLoading: boolean,
    courses: []
}
const props = withDefaults(defineProps<Props>(), {
    isLoading: false
})
</script>

<style lang="sass" module>
.wrapper
    display: flex
    justify-content: center

.emptyTitle
    @include h2
    color: $blue-main

.loaderContainer
    display: flex
    justify-content: center
    align-items: center
    min-height: 50vh

.list
    display: flex
    flex-wrap: wrap
    gap: $offset-m
    width: 100%

.courseLink
    @include trans
    width: calc((100% - 24px * 2) / 3)
    cursor: pointer

    @include responsive($tablet)
        width: calc((100% - 24px * 2) / 2)

    @include responsive($mobile)
        width: 100%

    @include hover
        transform: scale(1.02)

.courseItem
    height: 100%
</style>
