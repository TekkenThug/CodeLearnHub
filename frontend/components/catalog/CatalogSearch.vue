<template>
  <section class="catalog-search">
    <div class="catalog-search__field">
      <UiInput
        v-model="searchValue"
        placeholder="Найти курс по словам..."
        :disabled="isLoading"
      >
        <template #prefix>
          <Icon name="ic:outline-search" />
        </template>
      </UiInput>
    </div>

    <UiButton
      :is-loading="props.isLoading"
      class="catalog-search__button"
      @click="$emit('change', searchValue)"
    >
      Искать
    </UiButton>
  </section>
</template>

<script setup lang="ts">
const props = withDefaults(defineProps<{ isLoading: boolean }>(), {
  isLoading: false
})

const searchValue = ref('')

defineEmits<{(e: 'change', value: string): void }>()
</script>

<style lang="sass">
.catalog-search
  display: flex

  &__button
    margin-left: $offset-xxs
    flex-shrink: 0

  &__field
    flex-grow: 1
</style>
