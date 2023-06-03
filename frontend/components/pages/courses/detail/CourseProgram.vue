<template>
    <section class="section">
        <div class="container">
            <h2 :class="$style.subtitle">
                Программа курса
            </h2>

            <ul>
                <li
                    v-for="module in modules"
                    :key="module.id"
                    :class="$style.module"
                >
                    <div :class="$style.moduleTitle">
                        Модуль {{ module.order }} - {{ module.title }}
                    </div>

                    <ul>
                        <li
                            v-for="lesson in module.lessons"
                            :key="lesson.id"
                            :class="$style.lesson"
                        >
                            {{ module.order }}.{{ lesson.order }} - {{ lesson.name }}
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </section>
</template>

<script setup>
const props = defineProps({
    modules: {
        type: Array,
        default: () => ([])
    }
})
</script>

<style lang="sass" module>
.subtitle
    @include h2
    color: $blue-main
    margin-bottom: $offset-s

.module
    padding: $offset-l 0

    &:first-child
        padding-top: 0

    &:not(:last-child)
        border-bottom: 1px solid $gray-300
        margin-bottom: $offset-m

.moduleTitle
    @include h3
    font-size: 21px
    font-weight: 600
    color: $blue-dark-card
    margin-bottom: $offset-s

.lesson
    @include p1
    font-size: 18px
    font-weight: 600

    &:not(:last-child)
        margin-bottom: $offset-xxs
</style>
