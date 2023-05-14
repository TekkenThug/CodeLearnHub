<template>
  <main class="catalog">
    <div class="container">
      <div class="catalog__wrapper">
        <h1 class="catalog__title">
          Найдено 228 курсов
        </h1>

        <CatalogSearch
          :is-loading="isLoading"
          class="catalog__top"
          @change="(value) => updateDataControls('searchValue', value)"
        />

        <div class="catalog__bottom">
          <CatalogFilter class="catalog__filter" />

          <CatalogCourses class="catalog__courses" />
        </div>
      </div>
    </div>
  </main>
</template>

<script setup lang="ts">
interface SearchParams {
  searchValue: string,
}

const isLoading = ref(false)
const values = ref<SearchParams>({
  searchValue: ''
})

const updateDataControls = (key: keyof SearchParams, value: string) => {
  values.value[key] = value

  getCourses()
}

const http = useHttp()
const getCourses = () => {
  isLoading.value = true
  setTimeout(() => {
    http.get('/api/v1/courses')
    isLoading.value = false
  }, 4000)
}
</script>

<style lang="sass" scoped>
.catalog
  padding: $py-main-regular 0

  &__title
    margin-bottom: $offset-m
    font-size: $font-heading
    line-height: $lh-heading
    font-weight: 600

  &__top
    margin-bottom: $offset-xs

  &__bottom
    display: flex

  &__filter
    flex-shrink: 0
    width: 240px
    margin-right: $offset-s

  &__courses
    flex-grow: 1
</style>
