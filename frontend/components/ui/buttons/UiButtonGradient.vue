<template>
  <button class="ui-button-gradient">
    <slot />
  </button>
</template>

<style lang="sass">
.ui-button-gradient
  @include trans
  display: flex
  justify-content: center
  align-items: center
  background: linear-gradient(180deg, #FFC27A 0%, #FFA337 100%), linear-gradient(180deg, #FFB0BA 0%, #F9475D 100%), #FFFFFF
  background-size: 70px 70px
  border-radius: 100px
  padding: 12px 24px
  color: $white

  &:hover
    background-position-y: -10px
</style>
