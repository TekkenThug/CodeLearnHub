import { useUserStore } from '~/stores/user'

export default defineNuxtRouteMiddleware(async() => {
    const store = useUserStore()

    await store.getUserInfo()

    if (!store?.user?.roles.find(role => role === 'admin')) {
        return navigateTo('/')
    }
})
