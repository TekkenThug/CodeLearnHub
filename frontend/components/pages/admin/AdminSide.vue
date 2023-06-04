<template>
    <aside>
        <ul :class="$style.list">
            <li
                v-for="item in navigation"
                :key="item.id"
                :class="[$style.item, { [$style['_active']]: item.id === activeNavigation }]"
                @click="$emit('change', item.id)"
            >
                {{ item.title }}
            </li>
        </ul>
    </aside>
</template>

<script setup>
const emits = defineEmits(['change'])

const props = defineProps({
    activeNavigation: {
        type: String,
        required: true
    }
})

const navigation = ref([
    {
        title: 'Пользователи',
        id: 'users'
    },
    {
        title: 'Курсы',
        id: 'courses'
    },
    {
        title: 'Языки',
        id: 'languages'
    },
    {
        title: 'Новости',
        id: 'news'
    },
    {
        title: 'Обращения',
        id: 'tickets'
    }
])
</script>

<style lang="sass" module>
.list
    border-radius: $r-s
    padding: $offset-xxs
    border: 1px solid $blue-main

.item
    @include h3
    @include trans
    padding: $offset-xxs $offset-s
    border-radius: $r-s
    color: $blue-main
    cursor: pointer

    &:not(._active)
       @include hover
            color: $blue-dark-card

    &._active
        color: #fff
        background-color: $blue-dark-card

    &:not(:last-child)
        margin-bottom: $offset-xs
</style>
