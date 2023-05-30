<template>
    <div :class="$style.Controls">
        <button
            :class="$style.deleteButton"
            @click="$emit('delete')"
        >
            <Icon name="bi:trash" />
        </button>

        <button
            :class="[$style.moveButton]"
            @click="$emit('top')"
        >
            <Icon name="bi:arrow-up" />
        </button>

        <button
            :class="[$style.moveButton]"
            @click="$emit('bottom')"
        >
            <Icon name="bi:arrow-down" />
        </button>
    </div>
</template>

<script lang="ts" setup>
const emit = defineEmits<{
    (e: 'delete'): void,
    (e: 'top'): void,
    (e: 'bottom'): void
}>()
</script>

<style lang="sass" module>
.Controls
    display: flex

.deleteButton,
.moveButton
    display: flex
    justify-content: center
    align-items: center
    flex-shrink: 0
    border-radius: $r-s
    margin-left: $offset-xxs
    width: 30px
    height: 30px

.deleteButton
    background-color: $error-500
    color: #fff

.moveButton
    background-color: $gray-100
    color: #000
</style>
