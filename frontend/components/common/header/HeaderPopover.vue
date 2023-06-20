<template>
    <VDropdown
        v-if="isAuth"
        v-model:shown="isMenuShown"
        :distance="6"
        :auto-hide="false"
        placement="bottom-end"
        :class="$style.HeaderPopover"
    >
        <button :class="$style.profileButton">
            <AvatarImage
                :path="avatar"
                :class="$style.profileButtonAvatar"
            />

            <Icon
                :class="[$style.profileButtonIcon, { [$style['_active']]: isMenuShown }]"
                name="bi:chevron-down"
            />
        </button>

        <template #popper>
            <ul :class="$style.popover">
                <li :class="$style.popoverItem">
                    <NuxtLink
                        v-close-popper
                        to="/profile"
                        :class="$style.popoverItemLink"
                    >
                        Профиль
                    </NuxtLink>
                </li>

                <li :class="[$style.popoverItem, $style['_mobile']]">
                    <NuxtLink
                        v-close-popper
                        to="/courses"
                        :class="$style.popoverItemLink"
                    >
                        Каталог
                    </NuxtLink>
                </li>

                <li :class="[$style.popoverItem, $style['_mobile']]">
                    <NuxtLink
                        v-close-popper
                        to="/contacts"
                        :class="$style.popoverItemLink"
                    >
                        Контакты
                    </NuxtLink>
                </li>

                <li v-close-popper :class="$style.popoverItem">
                    <NuxtLink
                        to="/courses/create"
                        :class="$style.popoverItemLink"
                    >
                        Авторство
                    </NuxtLink>
                </li>

                <li v-if="isAdmin" v-close-popper :class="$style.popoverItem">
                    <NuxtLink
                        to="/admin"
                        :class="$style.popoverItemLink"
                    >
                        Админ-панель
                    </NuxtLink>
                </li>

                <li
                    v-if="isAuth"
                    v-close-popper
                    :class="[$style.popoverItem, $style.popoverItemLink]"
                    @click="logout"
                >
                    Выйти
                </li>
            </ul>
        </template>
    </VDropdown>
</template>

<script setup>
import { useUserStore } from '~/stores/user'
import AvatarImage from '~/components/common/avatar/AvatarImage'

const store = useUserStore()
const logout = async() => {
    await store.logout()
    navigateTo('/')
}
const isAuth = computed(() => store.isAuth)
const isAdmin = computed(() => store.isAdmin())
const avatar = computed(() => store?.user?.avatar)

const isMenuShown = ref(false)
</script>

<style lang="sass" module>
.HeaderPopover
    @include responsive($mobile)
        margin-left: auto

.profileButton
    @include trans
    display: flex
    align-items: center
    border: 1px solid $blue-dark-card
    padding: 5px 10px
    margin-left: 20px
    border-radius: $r-s
    color: $blue-dark-card

    @include hover
        border-color: $blue-main
        color: $blue-main

    .profileButtonIcon
        @include trans
        flex-shrink: 0
        width: 16px
        height: 16px

        &._active
            transform: rotate(180deg)

.profileButtonAvatar
    flex-shrink: 0
    width: 24px
    height: 24px
    margin-right: $offset-xxs

.popoverItem
    @include trans
    border-radius: $r-s
    color: $blue-dark-card
    font-weight: 500
    font-size: 14px
    text-align: right
    cursor: pointer

    &:not(:last-child)
        margin-bottom: 5px

    &._mobile
        display: none

        @include responsive($mobile)
            display: block

    @include hover
        color: #fff
        background-color: $blue-dark-card

.popoverItemLink
    display: block
    padding: 10px 20px

:global(.v-popper--theme-dropdown .v-popper__inner)
    padding: 8px
</style>
