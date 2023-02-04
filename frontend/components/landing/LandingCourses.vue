<template>
  <section class="landing-courses">
    <div class="container">
      <LandingEntrance :title="title" :subtitle="subtitle" />

      <LandingSlider>
        <SplideSlide
          v-for="item in courses"
          :key="item.link"
          class="landing-courses__slide"
        >
          <NuxtLink :to="item.link" class="landing-courses__slide-link" />

          <div class="landing-courses__slide-top">
            <div class="landing-courses__slide-image">
              <img :src="item.image" alt="Course Image">

              <span class="landing-courses__slide-tag">
                {{ item.tag }}
              </span>
            </div>

            <h4 class="landing-courses__slide-title">
              {{ item.title }}
            </h4>

            <div class="landing-courses__slide-review">
              <UiStars :count="item.stars" />

              <span class="landing-courses__slide-review-count">
                {{ item.reviewCount }}
              </span>
            </div>
          </div>

          <div class="landing-courses__slide-bottom">
            <strong class="landing-courses__slide-price">
              {{ item.price }}
            </strong>

            <button class="landing-courses__slide-btn">
              <Icon name="carbon:arrow-up-right" />
            </button>
          </div>
        </SplideSlide>
      </LandingSlider>
    </div>
  </section>
</template>

<script lang="ts" setup>
import LandingEntrance from './common/LandingEntrance.vue'
import LandingSlider from './common/LandingSlider.vue'
import UiStars from '~/components/ui/UiStars.vue'

interface CourseCardShort {
  tag: string,
  image: string,
  title: string,
  reviewCount: number,
  stars: number,
  price: string,
  link: string
}

const title = ref('Наиболее <span class="blue">популярные курсы</span>')
const subtitle = ref('Various versions have evolved over the years, sometimes by accident,')

const courses = ref<CourseCardShort[]>([
  {
    tag: 'HTML',
    image: 'https://images.unsplash.com/photo-1515879218367-8466d910aaa4?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8cHJvZ3JhbW1pbmclMjBjb2RlfGVufDB8fDB8fA%3D%3D&w=1000&q=80',
    title: 'Various versions have evolved daf Various versions have evolved daf',
    reviewCount: 15,
    stars: 3,
    price: '$ 500',
    link: '/'
  },
  {
    tag: 'HTML',
    image: 'https://images.unsplash.com/photo-1515879218367-8466d910aaa4?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8cHJvZ3JhbW1pbmclMjBjb2RlfGVufDB8fDB8fA%3D%3D&w=1000&q=80',
    title: 'Various versions have evolved daf Various versions have evolved daf',
    reviewCount: 15,
    stars: 3,
    price: '$ 500',
    link: '/'
  },
  {
    tag: 'HTML',
    image: 'https://images.unsplash.com/photo-1515879218367-8466d910aaa4?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8cHJvZ3JhbW1pbmclMjBjb2RlfGVufDB8fDB8fA%3D%3D&w=1000&q=80',
    title: 'Various versions have evolved daf Various versions have evolved daf',
    reviewCount: 15,
    stars: 3,
    price: '$ 500',
    link: '/'
  },
  {
    tag: 'HTML',
    image: 'https://images.unsplash.com/photo-1515879218367-8466d910aaa4?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8cHJvZ3JhbW1pbmclMjBjb2RlfGVufDB8fDB8fA%3D%3D&w=1000&q=80',
    title: 'Various versions have evolved daf Various versions have evolved daf',
    reviewCount: 15,
    stars: 3,
    price: '$ 500',
    link: '/'
  }
])
</script>

<style lang="sass" scoped>
.landing-courses
  padding: 80px 0

  &__slide
    position: relative
    display: flex
    flex-direction: column
    padding: 16px 0
    border-radius: 24px
    background-color: $white
    box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px
    height: auto
    margin-top: 20px
    margin-bottom: 30px

    &:hover
      .landing-courses__slide-btn
        background-color: $secondary-500

        .icon
          color: $white

  &__slide-link
    position: absolute
    top: 0
    left: 0
    width: 100%
    height: 100%
    z-index: 2

  &__slide-top
    padding: 0px 16px 16px

  &__slide-image
    position: relative
    border-radius: 12px
    height: 200px
    margin-bottom: 16px
    overflow: hidden

    img
      width: 100%
      height: 100%
      object-fit: cover
      object-position: center

  &__slide-tag
    position: absolute
    top: 7px
    left: 8px
    background-color: rgba($white, .6)
    border-radius: 6px
    color: $black
    padding: 6px 13px
    font-weight: 500

  &__slide-title
    color: $gray-700
    font-size: 20px
    line-height: $lh-body-regular
    font-weight: 500
    display: -webkit-box
    overflow: hidden
    -webkit-line-clamp: 1
    -webkit-box-orient: vertical
    margin-bottom: 16px

  &__slide-review
    display: flex
    justify-content: space-between

  &__slide-review-count
    margin-left: 11px
    color: $gray-600

  &__slide-bottom
    display: flex
    align-items: center
    justify-content: space-between
    padding: 16px 16px 0
    border-top: 1px solid $gray-50
    margin-top: auto

  &__slide-price
    color: $black
    font-weight: 600
    font-size: 24px
    line-height: 32px

  &__slide-btn
    @include trans
    display: flex
    justify-content: center
    align-items: center
    border-radius: 50%
    color: $secondary-500
    width: 44px
    height: 44px
    background: linear-gradient(180deg, rgba(255, 194, 122, 0.12) 0%, rgba(255, 163, 55, 0.12) 100%)

    .icon
      @include trans
      width: 24px
      height: 24px
</style>
