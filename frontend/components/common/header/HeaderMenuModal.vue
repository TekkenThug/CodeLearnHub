<template>
  <VueFinalModal
    :class="$style.HeaderMenuModal"
    overlay-transition="vfm-fade"
    content-transition="vfm-fade"
  >
    <HeaderNav :items="items" />
  </VueFinalModal>
</template>

<script lang="ts" setup>
import { VueFinalModal } from 'vue-final-modal'
import HeaderNav from './HeaderNav.vue'

const props = defineProps<{
    items: {
        name: string,
        link?: string,
        visible: boolean
        callback?: Function
    }[]
}>()
</script>

<style lang="sass" module>
//.HeaderMenuModal
//    position: absolute
//    right: 0
</style>
