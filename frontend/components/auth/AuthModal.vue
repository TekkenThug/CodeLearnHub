<template>
  <VueFinalModal
    class="confirm-modal"
    content-class="auth-modal"
    overlay-transition="vfm-fade"
    content-transition="vfm-fade"
  >
    <div class="auth-modal__image" />

    <Transition name="slide-fade" mode="out-in">
      <AuthModalLogin
        v-if="mode === 'login'"
        @change-mode="changeMode"
        @complete="closeAll"
      />

      <AuthModalRegister v-else-if="mode === 'register'" @change-mode="changeMode" />

      <AuthModalForgot v-else-if="mode === 'forgot'" @change-mode="changeMode" />
    </Transition>
  </VueFinalModal>
</template>

<script setup lang="ts">
import { VueFinalModal } from 'vue-final-modal'

type Mode = 'login' | 'register' | 'forgot'

const props = defineProps<{initialMode: Mode}>()

const mode = ref(props.initialMode)
const changeMode = (value: Mode) => { mode.value = value }
const { closeAll } = useVfm()
</script>

<style lang="sass">
.confirm-modal
  display: flex
  justify-content: center
  align-items: center

.auth-modal
  position: relative
  display: flex
  background: $white
  border-radius: 10px
  overflow: hidden
  min-height: 425px

  &__content
    position: relative
    display: flex
    flex-direction: column
    justify-content: center
    align-items: center
    padding: 32px
    width: 320px

  &__overlay
    position: absolute
    top: 0
    left: 0
    height: 100%
    width: 100%

  &__image
    position: relative
    width: 180px
    background-image: url('~/assets/images/auth/linear.jpg')
    background-size: cover
    background-position: left
    background-repeat: no-repeat

    &::before
      content: ''
      position: absolute
      top: 0
      left: 0
      width: 100%
      height: 100%
      background-color: rgba($second-primary-500, .2)

  &__title
    margin-bottom: 16px
    text-align: center
    font-size: $font-subheading
    line-height: $lh-subheading

  &__form
    width: 100%

  &__form-input
    &:not(:last-child)
      margin-bottom: 12px

  &__submit
    width: 100%

  &__bottom
    display: flex
    flex-direction: column
    align-items: center
    margin-top: 16px
    font-size: 14px

    span
      color: $gray-300

</style>
