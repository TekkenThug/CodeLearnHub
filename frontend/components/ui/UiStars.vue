<template>
  <ul class="stars">
    <li
      v-for="star in 5"
      :key="star"
      class="stars__item"
    >
      <Icon name="material-symbols:star-rounded" :class="{ 'stars__item--filled': star <= props.count }" />
    </li>
  </ul>
</template>

<script setup lang="ts">
const props = defineProps<{
  count: number,
}>()
</script>

<style lang="sass">
.stars
  display: flex

  &__item
    color: $gray-50

    .icon
      width: 24px
      height: 24px

    &:not(:last-child)
      margin-right: 5px

    &--filled
      color: $secondary-500
</style>
