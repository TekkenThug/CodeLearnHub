<template>
    <main>
        <LandingStart />

        <LandingCourses />

        <LandingQuestions />
    </main>
</template>

<script setup lang="ts">
import LandingStart from '~/components/pages/landing/LandingStart.vue'
import LandingCourses from '~/components/pages/landing/LandingCourses.vue'
import LandingQuestions from '~/components/pages/landing/questions/LandingQuestions.vue'
</script>
