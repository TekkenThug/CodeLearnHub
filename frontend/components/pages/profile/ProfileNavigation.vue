<template>
    <aside :class="$style.ProfileNavigation">
        <ul :class="$style.list">
            <li
                v-for="item in navigation"
                :key="item.name"
                :class="$style.item"
            >
                <NuxtLink
                    :to="item.link"
                    :class="$style.link"
                    :active-class="$style['_active']"
                >
                    {{ item.name }}
                </NuxtLink>
            </li>
        </ul>
    </aside>
</template>

<script lang="ts" setup>
const navigation = ref([
    {
        name: 'Профиль',
        link: '/settings/profile'
    },
    {
        name: 'Настройки',
        link: '/settings/admin'
    },
    {
        name: 'Авторство',
        link: '/settings/author'
    }
])
</script>

<style lang="sass" module>
.ProfileNavigation
    width: 300px
    padding: $offset-xxs
    background: $white
    border-radius: $r-m
    border: 1px solid $blue-main
    flex-shrink: 0

    @include responsive($mobile)
        width: 100%

.list
    @include responsive($mobile)
        display: flex

.item
    @include trans
    border-radius: $r-m
    color: $blue-dark-card

    &:not(:last-child)
        margin-bottom: $offset-xxs

        @include responsive($mobile)
            margin-bottom: 0
            margin-right: $offset-xxs

    @include responsive($mobile)
        text-align: center
        flex-grow: 1

.link
    @include trans
    @include h3
    font-size: 16px
    display: block
    border-radius: $r-m
    padding: 8px $offset-xxs

    @include responsive($mobile)
        padding: 8px

    &:not(._active)
        @include hover
            background-color: #fff

    &._active
        background-color: $blue-main
        color: $white
</style>
