<template>
    <section :class="[$style.LandingStart]">
        <div class="container">
            <div :class="$style.wrapper">
                <div :class="$style.left">
                    <div>
                        <h1 :class="$style.title">
                            {{ title }}
                        </h1>

                        <div
                            :class="$style.description"
                            v-html="description"
                        />
                    </div>

                    <UiButton
                        :class="$style.button"
                        @click="openPopup"
                    >
                        Начать
                    </UiButton>
                </div>

                <div :class="$style.right">
                    <img
                        src="~/assets/images/landing/girl.png"
                        alt="Girl"
                    >
                </div>
            </div>
        </div>
    </section>
</template>

<script lang="ts" setup>
import AuthModal from '~/components/auth/AuthModal.vue'

const title = ref('Лучшие курсы по программированию')
const description = ref('Самый быстрый способ попробовать программирование прямо в браузере. Бесплатные курсы с тренажером. Практика после каждого урока.')

const { open: openPopup } = useModal({
    component: AuthModal,
    attrs: { initialMode: 'register' }
})
</script>

<style lang="sass" module>
.LandingStart
    padding-top: 80px
    padding-bottom: 40px

    & > :global(.container)
        height: 100%

.wrapper
    display: flex
    justify-content: space-between
    align-items: center

.left
    max-width: 45%

    @include responsive($tablet)
        max-width: none

.button
    @include h3
    margin-top: 32px

    @include responsive($tablet)
        width: 100%

.title
    @include h1
    color: $blue-main
    margin-bottom: $offset-m

.description
    @include h3
    color: $blue-dark-card

.right
    max-width: 470px
    margin-left: $offset-s

    @include responsive($tablet)
        display: none

    img
        width: 100%
        height: 100%
        object-fit: contain
</style>
