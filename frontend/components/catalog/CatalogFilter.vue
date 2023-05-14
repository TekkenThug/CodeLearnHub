<template>
  <aside class="catalog-filter">
    <div class="catalog-filter__section">
      <strong class="catalog-filter__section-title">
        Рейтинг
      </strong>
    </div>

    <div class="catalog-filter__section">
      <strong class="catalog-filter__section-title">
        Категория
      </strong>
    </div>

    <div class="catalog-filter__section">
      <strong class="catalog-filter__section-title">
        Цена
      </strong>
    </div>
  </aside>
</template>

<style lang="sass" scoped>
.catalog-filter
  padding: 12px
  border-radius: $r-m
  border: 1px solid $gray-100
  background-color: rgba($gray-50, .5)

  &__section
    border-bottom: 1px solid $gray-100

    &:not(:last-child)
      margin-bottom: 32px
</style>
