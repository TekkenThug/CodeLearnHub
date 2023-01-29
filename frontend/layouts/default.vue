<template>
  <div>
    <TheHeader />

    <slot />
  </div>
</template>

<script setup lang="ts">
import TheHeader from '~/components/common/TheHeader.vue'
</script>
