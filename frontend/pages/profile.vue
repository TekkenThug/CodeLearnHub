<template>
    <main class="page">
        <transition name="fade">
            <UiOverlay v-if="isLoading" />

            <div v-else class="container">
                <ProfileSection
                    class="section"
                    title="Настройки профиля"
                >
                    <ProfileSettings />
                </ProfileSection>

                <ProfileSection
                    class="section"
                    title="Мои курсы"
                >
                    <ProfileCourses :courses="userCourses" :show-progress="true">
                        У Вас нет курсов к прохождению

                        <NuxtLink to="/courses">
                            <UiButton>
                                В каталог
                            </UiButton>
                        </NuxtLink>
                    </ProfileCourses>
                </ProfileSection>

                <ProfileSection
                    class="section"
                    title="Созданные курсы"
                >
                    <ProfileCourses :courses="userAuthoredCourses">
                        <template v-if="!isAuthor">
                            Вы не являетесь автором

                            <NuxtLink to="/courses/create">
                                <UiButton>
                                    Стать им!
                                </UiButton>
                            </NuxtLink>
                        </template>

                        <template v-else>
                            Вы не создали курсов

                            <NuxtLink to="/courses/create">
                                <UiButton>
                                    К созданию
                                </UiButton>
                            </NuxtLink>
                        </template>
                    </ProfileCourses>
                </ProfileSection>
            </div>
        </transition>
    </main>
</template>

<script setup>
import { useUserStore } from '~/stores/user'
import { useCourseStore } from '~/stores/course'
import UiButton from '~/components/ui/buttons/UiButton'
import UiOverlay from '~/components/ui/UiOverlay.vue'
import ProfileSection from '~/components/pages/profile/ProfileSection'
import ProfileSettings from '~/components/pages/profile/ProfileSettings'
import ProfileCourses from '~/components/pages/profile/ProfileCourses'

const notify = useToast()
const store = useUserStore()
const courseStore = useCourseStore()

const isLoading = ref(true)
const userCourses = ref([])
const userAuthoredCourses = ref([])

const isAuthor = computed(() => store.isAuthor())

onBeforeMount(async() => {
    await store.getUserInfo()

    try {
        const { data: courses } = await courseStore.getMyCourses()
        const { data: authorCourses } = await courseStore.getMyAuthoredCourses()

        userCourses.value = courses.courses
        userAuthoredCourses.value = authorCourses.courses
    } catch (e) {
        if (e?.response?.data) {
            notify.error(e.response.data.error || e.response.data.message)
        }
    } finally {
        isLoading.value = false
    }
})

definePageMeta({
    middleware: ['auth']
})
</script>
