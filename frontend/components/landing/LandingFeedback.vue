<template>
  <section class="landing-feedback">
    <div class="container">
      <LandingEntrance :title="title" :subtitle="subtitle" />

      <LandingSlider>
        <SplideSlide
          v-for="student in students"
          :key="student"
          class="landing-feedback__slide"
        >
          <NuxtLink :to="student.link" class="landing-feedback__slide-link" />

          <div class="landing-feedback__slide-top">
            <div class="landing-feedback__slide-image">
              <img :src="student.image" alt="Student">
            </div>

            <div class="landing-feedback__slide-info">
              <h3 class="landing-feedback__slide-name">
                {{ student.name }}
              </h3>

              <p class="landing-feedback__slide-work">
                {{ student.work }}
              </p>
            </div>

            <Icon name="material-symbols:format-quote-rounded" class="landing-feedback__slide-quote" />
          </div>

          <p class="landing-feedback__slide-feedback">
            {{ student.feedback }}
          </p>
        </SplideSlide>
      </LandingSlider>
    </div>
  </section>
</template>

<script setup lang="ts">
const title = ref('Отзывы <span class="blue">студентов</span>')
const subtitle = ref('Various versions have evolved over the years, sometimes by accident')

const students = ref([
  {
    name: 'Vadim Ignatov',
    image: 'https://i1.sndcdn.com/artworks-BXugSxIERNzWqoyd-ZCnyCA-t500x500.jpg',
    work: 'Web developer',
    feedback: 'Good feedback',
    link: '/'
  },
  {
    name: 'Vadim Ignatov',
    image: 'https://i1.sndcdn.com/artworks-BXugSxIERNzWqoyd-ZCnyCA-t500x500.jpg',
    work: 'Web developer',
    feedback: 'Good feedback',
    link: '/'
  },
  {
    name: 'Vadim Ignatov',
    image: 'https://i1.sndcdn.com/artworks-BXugSxIERNzWqoyd-ZCnyCA-t500x500.jpg',
    work: 'Web developer',
    feedback: 'Good feedback',
    link: '/'
  },
  {
    name: 'Vadim Ignatov',
    image: 'https://i1.sndcdn.com/artworks-BXugSxIERNzWqoyd-ZCnyCA-t500x500.jpg',
    work: 'Web developer',
    feedback: 'Good feedback',
    link: '/'
  },
  {
    name: 'Vadim Ignatov',
    image: 'https://i1.sndcdn.com/artworks-BXugSxIERNzWqoyd-ZCnyCA-t500x500.jpg',
    work: 'Web developer',
    feedback: 'Good feedback',
    link: '/'
  }
])
</script>

<style lang="sass" scoped>
.landing-feedback
  padding: $p-section-regular 0
  background-color: #F8F4FF

  &__slide
    position: relative
    display: flex
    flex-direction: column
    padding: 32px
    background-color: $white
    border-radius: 30px
    height: auto
    margin-top: 20px
    margin-bottom: 30px

  &__slide-link
    position: absolute
    top: 0
    left: 0
    width: 100%
    height: 100%

  &__slide-top
    position: relative
    align-items: center
    display: flex
    padding-right: 35px
    margin-bottom: 30px

  &__slide-image
    border-radius: 50%
    overflow: hidden
    width: 60px
    height: 60px
    margin-right: 10px

    img
      width: 100%
      height: 100%
      object-fit: cover
      object-position: center

  &__slide-name
    font-weight: 600
    font-size: $font-body-large
    margin-bottom: 8px

  &__slide-quote
    position: absolute
    right: 0
    top: 0
    color: $secondary-500
    width: 40px
    height: 29px

  &__slide-feedback
    color: $gray-700
    margin-top: auto
</style>
