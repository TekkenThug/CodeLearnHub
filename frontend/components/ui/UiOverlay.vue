<template>
  <div class="ui-overlay">
    <UiLoader class="ui-overlay__loader" />
  </div>
</template>

<style lang="sass">
.ui-overlay
  position: absolute
  display: flex
  justify-content: center
  align-items: center
  background-color: rgba($gray-100, .8)

  &__loader
    position: relative
</style>
