<template>
    <button
        :class="$style.entranceButton"
        @click="$emit('open')"
    >
        Войти

        <Icon
            name="bi:door-open"
            :class="$style.entranceButtonIcon"
        />
    </button>
</template>

<script setup>
const emits = defineEmits(['open'])
</script>

<style lang="sass" module>
.entranceButton
    display: none
    align-items: center
    margin-left: auto
    padding: 0
    font-weight: 500
    color: $blue-dark-card
    font-family: $font-title

    @include responsive($mobile)
        display: flex

.entranceButtonIcon
    margin-left: $offset-xxs
</style>
