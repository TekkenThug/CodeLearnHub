<template>
  <section class="landing-start">
    <div class="container">
      <div class="landing-start__wrapper">
        <div class="landing-start__left">
          <p class="landing-start__suptitle">
            Путь к успеху
          </p>

          <h1 class="landing-start__title">
            Получите доступ к 1000+ курсам от 100 преподавателей
          </h1>

          <div class="landing-start__subtitle">
            Various versions have evolved over the years, sometimes by accident,
          </div>

          <div class="landing-start__search-field">
            <input
              v-model="searchValue"
              type="text"
              placeholder="Что вы хотите изучить?"
            >

            <button class="landing-start__search-btn">
              <Icon name="ic:baseline-search" />
            </button>
          </div>
        </div>

        <div class="landing-start__right">
          <div class="landing-start__image">
            <img src="~/assets/images/landing/Saly.png" alt="Saly">
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup lang="ts">
const searchValue = ref('')
</script>

<style lang="sass" scoped>
.landing-start
  height: 100vh
  background-color: $blue

  & > .container
    height: 100%

  &__wrapper
    display: flex
    justify-content: space-between
    align-items: center
    height: 100%

  &__left
    flex-basis: 50%
    flex-shrink: 0
    margin-right: 20px

  &__suptitle
    margin-bottom: 32px
    font-size: $font-subheading
    line-height: $lh-subheading
    font-weight: 500
    text-transform: uppercase
    color: $secondary-500

  &__title
    margin-bottom: 24px
    font-weight: 600
    font-size: $font-heading
    line-height: $lh-heading
    color: $white

  &__subtitle
    margin-bottom: 32px
    font-size: $font-body-large
    line-height: $lh-body-large
    color: $gray-100

  &__image
    flex-basis: 40%
    flex-shrink: 1

    img
      display: block
      width: 100%
      transform: translateY(-40px)

  &__search-field
    position: relative

    input
      display: block
      width: calc(100% - 20px)
      padding: 18px 60px 18px 28px
      border-radius: 1000px

      &::placeholder
        color: $gray-500

  &__search-btn
    position: absolute
    right: 20px
    top: 0
    height: 54px
    width: 54px
    display: flex
    justify-content: center
    align-items: center
    background: linear-gradient(180deg, #FFC27A 0%, #FFA337 100%), linear-gradient(180deg, #FFB0BA 0%, #F9475D 100%), #FFFFFF
    background-size: 70px 70px
    border-radius: 100%
    @include trans

    &:hover
      background-position-y: -10px

    .icon
      color: $white
</style>
