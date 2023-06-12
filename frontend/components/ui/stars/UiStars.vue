<template>
    <ul :class="$style.UiStars">
        <li
            v-for="number in 5"
            :key="number"
            :class="[$style.star, { [$style['_no-pointer']]: !isEditable || pinned }]"
            @mouseenter="setFillable(number)"
            @mouseleave="setFillable(0)"
            @click="select(number)"
        >
            <Icon
                :name="fillable >= number ? 'bi:star-fill' : 'bi:star'"
            />
        </li>
    </ul>
</template>

<script setup>
const emits = defineEmits(['select'])
const props = defineProps({
    defaultStarsCount: {
        type: Number,
        default: 0
    },

    isEditable: {
        type: Boolean,
        default: true
    }
})

const fillable = ref(props.defaultStarsCount)
const pinned = ref(false)

const select = (number) => {
    if (!props.isEditable || pinned.value) {
        return
    }

    emits('select', number)
    fillable.value = number
    pinned.value = true
}

const setFillable = (number) => {
    if (!props.isEditable || pinned.value) {
        return
    }

    fillable.value = number
}
</script>

<style lang="sass" module>
.UiStars
    display: flex

.star
    color: $orange-light
    cursor: pointer

    &._no-pointer
        cursor: default

    &:not(:last-child)
        padding-right: $offset-xxs
</style>
