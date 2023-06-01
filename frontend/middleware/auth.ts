import { useUserStore } from '~/stores/user'

export default defineNuxtRouteMiddleware(async() => {
    const store = useUserStore()

    await store.getUserInfo()

    if (!store.isAuth) {
        return navigateTo('/')
    }
})
