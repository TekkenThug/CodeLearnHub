<template>
    <Transition name="fade">
        <div v-if="props.isLoading" class="ui-overlay">
            <UiLoader class="ui-overlay__loader" />
        </div>
    </Transition>
</template>

<script setup lang="ts">
const props = withDefaults(defineProps<{ isLoading?: boolean }>(), {
    isLoading: false
})
</script>

<style lang="sass">
.ui-overlay
  position: absolute
  z-index: 1
  display: flex
  justify-content: center
  align-items: center
  background-color: rgba($white, .75)

  &__loader
    position: relative
</style>
