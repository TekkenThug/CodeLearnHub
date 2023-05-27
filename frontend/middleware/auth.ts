import { useUserStore } from '~/stores/user'

export default defineNuxtRouteMiddleware(() => {
    const store = useUserStore()

    if (!store.isAuth) {
        return navigateTo('/')
    }
})
