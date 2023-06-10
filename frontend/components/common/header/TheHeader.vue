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

                <HeaderPopover />

                <HeaderMobileEntrance
                    v-if="!isAuth"
                    @open="processPopup('login')"
                />
            </div>
        </div>
    </header>
</template>

<script setup lang="ts">
import { useUserStore } from '~/stores/user'
import AuthModal from '~/components/auth/AuthModal.vue'
import HeaderNav from '~/components/common/header/HeaderNav.vue'
import HeaderPopover from '~/components/common/header/HeaderPopover'
import HeaderMobileEntrance from '~/components/common/header/HeaderMobileEntrance'

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

const isAuth = computed(() => store.isAuth)

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
            name: 'Войти',
            visible: !isAuth.value,
            callback: () => processPopup('login')
        }
    ]
})
</script>

<style lang="sass" module>
.TheHeader
    position: fixed
    top: 0
    left: 0
    z-index: $z-header
    width: 100%
    padding: $offset-xxs 0
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
</style>
