<template>
    <main class="page">
        <AuthorCreate v-if="isAuthor" />

        <AuthorBanner v-else />
    </main>
</template>

<script setup>
import { useUserStore } from '~/stores/user'
import AuthorBanner from '~/components/pages/courses/create/AuthorBanner'
import AuthorCreate from '~/components/pages/courses/create/AuthorCreate'

const userStore = useUserStore()

const isAuthor = computed(() => userStore.isAuthor())

definePageMeta({
    middleware: ['auth']
})
</script>
