<template>
  <section class="landing-category">
    <div class="container">
      <LandingEntrance :title="title" :subtitle="subtitle" />

      <ul class="landing-category__list">
        <li
          v-for="item in categories"
          :key="item.icon"
          class="landing-category__item"
        >
          <div class="landing-category__item-left">
            <Icon :name="item.icon" />

            <span>{{ item.title }}</span>
          </div>

          <div class="landing-category__item-right">
            <Icon name="carbon:arrow-up-right" />
          </div>

          <NuxtLink :to="item.link" class="landing-category__item-link" />
        </li>
      </ul>
    </div>
  </section>
</template>

<script setup lang="ts">
import LandingEntrance from './common/LandingEntrance.vue'

const categories = ref<{ icon: string, title: string, link: string }[]>([
  {
    icon: 'carbon:pen',
    title: 'Дизайн',
    link: '/'
  }
])

const title = ref('Наиболее <span class="blue">популярные категории</span>')
const subtitle = ref('Various versions have evolved over the years, sometimes by accident')
</script>

<style lang="sass" scoped>
.landing-category
  padding: 80px 0
  background-color: $second-primary

  &__list
    display: flex
    flex-wrap: wrap
    margin-bottom: -24px
    margin-right: -24px

  &__item
    @include trans
    display: flex
    align-items: center
    justify-content: space-between
    position: relative
    width: calc((100% - (24px * 3)) / 4)
    margin-bottom: 24px
    margin-right: 24px
    background-color: $white
    border-radius: 22px
    border: 2px solid transparent
    padding: 12px 20px

    &:hover
      border-color: $secondary-500
      box-shadow: 0px 12px 48px rgba(255, 194, 122, .26)

      .landing-category__item-right
        background-color: $secondary-500
        box-shadow: -4px 4px 20px rgba(242, 206, 18, .12)

        .icon
          color: $white

  &__item-link
    position: absolute
    top: 0
    left: 0
    width: 100%
    height: 100%

  &__item-left
    display: flex
    align-items: center
    margin-right: 8px

    .icon
      width: 38px
      height: 38px
      margin-right: 16px
      opacity: .38

    span
      font-size: $font-body-large
      line-height: $lh-body-large
      font-weight: 500

  &__item-right
    @include trans
    display: flex
    justify-content: center
    align-items: center
    width: 44px
    height: 44px
    border-radius: 50%

    .icon
      @include trans
      width: 24px
      height: 24px
      color: $secondary-500
</style>
