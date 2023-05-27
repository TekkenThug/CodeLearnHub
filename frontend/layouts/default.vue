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

<script setup lang="ts">
import TheHeader from '~/components/common/header/TheHeader.vue'
import TheFooter from '~/components/common/TheFooter.vue'
import TestFlight from '~/components/common/TestFlight.vue'
</script>

<style lang="sass">
.layout-default
  display: flex
  flex-direction: column
  min-height: 100vh

  &__content
    flex-grow: 1
    padding-top: $header-height
</style>
