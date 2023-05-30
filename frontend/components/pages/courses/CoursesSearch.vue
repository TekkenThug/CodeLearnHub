<template>
    <div>
        <div class="container">
            <h1 :class="$style.title">
                Курсы
            </h1>

            <div :class="$style.searchField">
                <UiInput
                    v-model="searchValue"
                    :class="$style.input"
                    placeholder="Какой курс мы ищем?"
                />

                <UiButton
                    @click="$emit('search', searchValue)"
                    :class="$style.button"
                >
                    Поиск

                    <Icon
                        name="bi:search"
                        size="12"
                        :class="$style.buttonIcon"
                    />
                </UiButton>
            </div>
        </div>
    </div>
</template>

<script lang="ts" setup>
const searchValue = ref('')

interface Events {
    (e: 'search', value: string): void,
}
const emit = defineEmits<Events>()
</script>

<style lang="sass" module>
.title
    @include h1
    color: $blue-main
    margin-bottom: $offset-l

.searchField
    display: flex

.input
    flex-grow: 1
    margin-right: $offset-xxs

.button
    display: flex
    justify-content: center
    align-items: center
    font-family: $font-title

    .buttonIcon
        flex-shrink: 0
        width: 16px
        height: 16px
        margin-left: $offset-xxs
</style>
