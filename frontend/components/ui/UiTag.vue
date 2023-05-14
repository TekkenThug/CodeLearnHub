<template>
  <div class="ui-tag" :style="{ color: props.color, backgroundColor: props.background }">
    {{ props.text }}
  </div>
</template>

<script setup lang="ts">
interface CourseTag {
  background: string,
  color: string,
  text: string
}

const props = withDefaults(defineProps<CourseTag>(), {
  color: '#fff',
  background: '#3461FD'
})
</script>

<style lang="sass">
.ui-tag
  display: inline-block
  padding: 4px $offset-xxs
  font-size: 14px
  user-select: none
</style>
