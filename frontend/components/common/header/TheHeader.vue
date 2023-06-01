<template>
    <header :class="$style.TheHeader">
        <div class="container">
            <div :class="$style.wrapper">
                <NuxtLink to="/">
                    <img
                        :class="$style.logo"
                        src="~/assets/images/common/logo.png"
                        alt="Logo"
                    >
                </NuxtLink>

                <HeaderNav
                    :class="$style.nav"
                    :items="navigation"
                />

                <button
                    :class="$style.burgerButton"

                    @click="openMobilePopup"
                >
                    <Icon name="carbon:menu" />
                </button>
            </div>
        </div>
    </header>
</template>

<script setup lang="ts">
import { useUserStore } from '~/stores/user'
import AuthModal from '~/components/auth/AuthModal.vue'
import HeaderMenuModal from '~/components/common/header/HeaderMenuModal.vue'
import HeaderNav from '~/components/common/header/HeaderNav.vue'

const store = useUserStore()

type PopupMode = 'login' | 'register'

const popupMode = ref<PopupMode>('login')
const { open: openPopup } = useModal({
    component: AuthModal,
    attrs: { initialMode: popupMode }
})
const processPopup = (value: PopupMode) => {
    popupMode.value = value
    openPopup()
}

const http = useHttp()
const logout = () => {
    return http.post('/logout', {}).then(() => store.logout())
}

const navigation = computed(() => {
    return [
        {
            name: 'Главная',
            visible: true,
            link: '/'
        },
        {
            name: 'Каталог',
            visible: true,
            link: '/courses'
        },
        {
            name: 'Контакты',
            visible: true,
            link: '/contacts'
        },
        {
            name: 'Авторство',
            visible: true,
            link: '/courses/create'
        },
        {
            name: 'Войти',
            visible: !store.isAuth,
            callback: () => processPopup('login')
        },
        {
            name: 'Профиль',
            visible: store.isAuth,
            link: '/profile'
        },
        {
            name: 'Выйти',
            visible: store.isAuth,
            callback: async() => {
                await logout()
                navigateTo('/')
            }
        }
    ]
})

const { open: openMobilePopup } = useModal({
    component: HeaderMenuModal,
    attrs: { items: navigation }
})
</script>

<style lang="sass" module>
.TheHeader
    position: fixed
    top: 0
    left: 0
    z-index: $z-header
    width: 100%
    padding: $offset-xxs
    background-color: $white
    box-shadow: 0 4px 30px $blue-main

.wrapper
    display: flex
    align-items: center

.logo
    width: 72px
    height: 40px
    flex-shrink: 0

.nav
    @include responsive($mobile)
        display: none

.burgerButton
    display: none
    margin-left: auto

    @include responsive($mobile)
        display: block
</style>
