<template>
    <div
        :class="$style.LessonTop"
        :style="{ backgroundImage: `url('${cover}')` }"
    >
        <div :class="$style.left">
            <h1 :class="$style.top">
                {{ title }}
            </h1>

            <p>{{ subtitle }}</p>
        </div>

        <transition name="fade" mode="out-in">
            <div
                v-if="!rate"
                :class="$style.right"
            >
                Оцените курс

                <UiStars
                    :class="$style.rightStars"
                    @select="passRating"
                />
            </div>
        </transition>
    </div>
</template>

<script setup>
import UiStars from '~/components/ui/stars/UiStars'

const emits = defineEmits(['select-rating'])
const props = defineProps({
    title: {
        type: String,
        default: ''
    },

    subtitle: {
        type: String,
        default: ''
    },

    cover: {
        type: String,
        default: ''
    },

    rate: {
        type: Number,
        default: 0
    }
})

const passRating = (number) => {
    emits('select-rating', number)
}
</script>

<style lang="sass" module>
.LessonTop
    display: flex
    justify-content: space-between
    align-items: center
    padding: $offset-xl $offset-m
    color: #fff
    background-color: $blue-dark-card
    background-repeat: no-repeat
    background-size: cover
    background-position: center center
    position: relative

    &:before
        content: ''
        position: absolute
        z-index: 0
        left: 0
        top: 0
        width: 100%
        height: 100%
        background-color: rgba(#000, .5)

.top
    margin-bottom: $offset-xs

.left
    position: relative
    z-index: 1

.right
    text-align: right
    z-index: 1
    font-weight: 500

.rightStars
    margin-top: $offset-xxs
</style>
