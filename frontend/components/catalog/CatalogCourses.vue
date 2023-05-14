<template>
  <section class="catalog-courses">
    <ul class="catalog-courses__list">
      <CatalogCourseItem
        :mark="courses.mark"
        :description="courses.description"
        :title="courses.title"
      />
    </ul>
  </section>
</template>

<script setup lang="ts">

const courses = ref({
  title: 'Практический курс для новичков по SQL и PostgreSQL',
  description: 'Изучение SQL на простых примерах для новичков. Теория, практика, домашние задания и их разборы.',
  mark: 3
})

</script>
