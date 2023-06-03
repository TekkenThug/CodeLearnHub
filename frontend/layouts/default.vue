<template>
    <div class="layout-default">
        <TheHeader />

        <div class="layout-default__content">
            <slot />
        </div>

        <TheFooter />

        <TestFlight />
    </div>
</template>

<script setup>
import TheHeader from '~/components/common/header/TheHeader'
import TheFooter from '~/components/common/TheFooter'
import TestFlight from '~/components/common/TestFlight'
</script>

<style lang="sass">
.layout-default
  display: flex
  flex-direction: column

  &__content
    flex-grow: 1
    min-height: calc(100vh - #{$header-height})
    padding-top: $header-height
</style>
