<template>
    <li :class="$style.LandingQuestionsItem">
        <div
            :class="$style.questionItemQuestion"
            @click="isOpen = !isOpen"
        >
            {{ question }}

            <Icon
                name="bi:chevron-down"
                size="16"
                :class="[$style.icon, { [$style['_rotated']]: isOpen }]"
            />
        </div>

        <UiExpander :is-open="isOpen">
            <div :class="$style.questionItemAnswer">
                {{ answer }}
            </div>
        </UiExpander>
    </li>
</template>

<script lang="ts" setup>
const props = defineProps<{
    question: string,
    answer: string
}>()

const isOpen = ref(false)
</script>

<style lang="sass" module>
.LandingQuestionsItem
    padding: $offset-s $offset-m
    border-radius: $r-m
    background-color: $white
    border: 1px solid $blue-main
    box-shadow: 0 20px 30px rgba(91, 194, 208, 0.2)

.icon
    @include trans
    position: absolute
    right: 0
    top: 50%
    transform: translateY(-50%)

    &._rotated
        transform: translateY(-50%) rotate(-180deg)

.questionItemQuestion
    @include h3
    position: relative
    padding-right: 20px
    color: $blue-dark-card
    cursor: pointer
    user-select: none

.questionItemAnswer
    margin-top: $offset-s
    line-height: 24px
</style>
