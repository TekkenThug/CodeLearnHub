<template>
    <main>
        <LandingStart />

        <LandingCourses
            v-if="popularCourses && popularCourses.length"
            :courses="popularCourses"
        />

        <LandingQuestions />
    </main>
</template>

<script setup>
import { useCourseStore } from '~/stores/course'
import LandingStart from '~/components/pages/landing/LandingStart'
import LandingCourses from '~/components/pages/landing/LandingCourses'
import LandingQuestions from '~/components/pages/landing/questions/LandingQuestions'

const courseStore = useCourseStore()
const popularCourses = computed(() => {
    return courseStore.popularCourses
})
</script>
