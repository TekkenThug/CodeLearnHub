<template>
  <section class="landing-facts">
    <div class="container">
      <ul class="landing-facts__list">
        <li
          v-for="item in facts"
          :key="item.icon"
          class="landing-facts__item"
        >
          <div class="landing-facts__item-circle" :style="{ background: item.gradient }">
            <Icon :name="item.icon" />
          </div>

          <div class="landing-facts__item-content">
            <div class="landing-facts__item-value">
              {{ item.value }}
            </div>

            <div class="landing-facts__item-caption">
              {{ item.caption }}
            </div>
          </div>
        </li>
      </ul>
    </div>
  </section>
</template>

<script setup lang="ts">
const facts = ref<{ icon: string, gradient: string, value: string, caption: string }[]>([
  {
    icon: 'ic:baseline-cast-for-education',
    gradient: 'linear-gradient(180deg, #2AF9B1 0%, #20B486 100%)',
    value: '100',
    caption: 'Преподавателей'
  },
  {
    icon: 'ic:baseline-people-alt',
    gradient: 'linear-gradient(180deg, #A988F9 0%, #6D3AE9 100%)',
    value: '1000+',
    caption: 'Студентов'
  },
  {
    icon: 'ic:baseline-videocam',
    gradient: 'linear-gradient(180deg, #FFA4AF 0%, #EE455A 100%)',
    value: '5000+',
    caption: 'Видео'
  },
  {
    icon: 'ic:baseline-10k',
    gradient: 'linear-gradient(180deg, #92DAF0 0%, #21C9FF 100%)',
    value: '10000+',
    caption: 'Пользователей'
  }
])

</script>

<style lang="sass">
.landing-facts
  padding: 50px 0

  &__list
    display: flex
    justify-content: space-between

  &__item
    display: flex

  &__item-circle
    display: flex
    justify-content: center
    align-items: center
    width: 64px
    height: 64px
    margin-right: 24px
    border-radius: 50%

    .icon
      color: $white
      width: 32px
      height: 32px

  &__item-content
    display: flex
    flex-direction: column
    justify-content: space-between

  &__item-value
    font-weight: 600
    font-size: 24px
    line-height: 32px
    color: $black

  &__item-caption
    font-size: 18px
    line-height: 21px
    color: $gray-600
</style>
