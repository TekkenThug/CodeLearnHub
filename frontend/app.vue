<template>
    <div id="app">
        <NuxtLayout>
            <NuxtPage />
        </NuxtLayout>

        <ModalsContainer />

        <transition name="fade">
            <div
                v-if="isLoading"
                ref="loader"
                class="loader"
            >
                <UiLoader />
            </div>
        </transition>
    </div>
</template>

<script setup lang="ts">
import { ModalsContainer } from 'vue-final-modal'
import { disableBodyScroll, enableBodyScroll } from 'body-scroll-lock'
import { useUserStore } from './stores/user'

const http = useHttp()
const store = useUserStore()
const isLoading = ref(true)
const loader = ref<null | HTMLElement>(null)

const getStartData = async() => {
    if (!loader.value) {
        return
    }

    disableBodyScroll(loader.value)

    await http.get('/sanctum/csrf-cookie')
    await store.getUserInfo()

    enableBodyScroll(loader.value)
    isLoading.value = false
}

onMounted(async() => {
    await getStartData()
})
</script>
