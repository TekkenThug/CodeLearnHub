<template>
  <main class="landing">
    <LandingStart />

    <LandingFacts />

    <LandingCourses />

    <LandingCategory />

    <LandingInstructors />

    <LandingFeedback />
  </main>
</template>

<script setup lang="ts">
import LandingStart from '~/components/landing/LandingStart.vue'
import LandingFacts from '~/components/landing/LandingFacts.vue'
import LandingCategory from '~/components/landing/LandingCategory.vue'
import LandingCourses from '~/components/landing/LandingCourses.vue'
import LandingInstructors from '~/components/landing/LandingInstructors.vue'
import LandingFeedback from '~/components/landing/LandingFeedback.vue'
</script>

<style lang="sass">
</style>
