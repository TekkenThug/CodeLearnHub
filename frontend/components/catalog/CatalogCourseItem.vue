<template>
  <li class="catalog-course-item">
    <div class="catalog-course-item__top">
      <h3 class="catalog-course-item__title">
        {{ title }}
      </h3>

      <p class="catalog-course-item__description">
        {{ description }}
      </p>
    </div>

    <UiStars :count="mark" />

    <UiTag text="Тестовый" />
  </li>
</template>

<script setup lang="ts">
import { CourseTag } from '~/types/common'

interface CatalogCourse {
  image?: string,
  title: string,
  author: string,
  description: string,
  price: string,
  mark: number
  reviews: number
  hours: number,
  lessonsCount: number,
  level: 'beginner' | 'intermediate' | 'advanced',
  tags: CourseTag[]
}

const props = defineProps<CatalogCourse>()
</script>

<style lang="sass" scoped>
.catalog-course-item
  border: 1px solid $gray-50
  border-radius: $r-m
  padding: $offset-xs

  &__title
    font-weight: 600
    font-size: $font-subheading
    line-height: $lh-subheading
</style>
