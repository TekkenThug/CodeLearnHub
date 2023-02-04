<template>
  <section class="landing-instructors">
    <div class="container">
      <LandingEntrance :title="title" :subtitle="subtitle" />

      <LandingSlider>
        <SplideSlide
          v-for="instructor in instructors"
          :key="instructor.image"
          class="landing-instructors__slide"
        >
          <NuxtLink class="landing-instructors__slide-link" :to="instructor.link" />

          <div class="landing-instructors__slide-image">
            <img :src="instructor.image" alt="">
          </div>

          <div class="landing-instructors__slide-content">
            <h3 class="landing-instructors__slide-name">
              {{ instructor.name }}
            </h3>

            <p class="landing-instructors__slide-work">
              {{ instructor.work }}
            </p>
          </div>
        </SplideSlide>
      </LandingSlider>
    </div>
  </section>
</template>

<script setup lang="ts">
import LandingEntrance from './common/LandingEntrance.vue'
import LandingSlider from './common/LandingSlider.vue'

const title = ref('Наиболее <span class="blue">лучшие преподаватели</span>')
const subtitle = ref('Various versions have evolved over the years, sometimes by accident')
const instructors = ref([
  {
    name: 'Vadim Ignatov',
    work: 'Web developer',
    link: '/',
    image: 'https://i.pinimg.com/originals/b4/5d/a3/b45da3d003682c2091cf48add0419577.jpg'
  }
])
</script>

<style lang="sass" scoped>
.landing-instructors
  padding: 80px 0

  &__slide
    position: relative
    box-shadow: 0px 3px 12px rgba(75, 75, 75, 0.08)
    border-radius: 24px
    background-color: $white
    padding: 16px
    height: auto
    margin-top: 20px
    margin-bottom: 30px

  &__slide-link
    position: absolute
    top: 0
    left: 0
    width: 100%
    height: 100%

  &__slide-image
    height: 200px
    overflow: hidden
    border-radius: 12px

    img
      height: 100%
      width: 100%
      object-fit: cover
      object-position: center

  &__slide-content
    display: flex
    flex-direction: column
    align-items: center
    margin-top: 16px
    text-align: center

  &__slide-name
    color: $black
    font-size: 18px
    line-height: $lh-body-regular
    margin-bottom: 6px

  &__slide-work
    color: $gray-500
</style>
