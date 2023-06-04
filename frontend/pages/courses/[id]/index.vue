<template>
    <main>
        <UiOverlay v-if="isLoading || !course" />

        <div v-else>
            <CourseHead
                :course="course"
                :enabled-button="isAuth"
                @start="startCourse"
            />

            <CourseDescription
                :description="course.description"
            />

            <CourseProgram
                v-if="modules && modules.length"
                :modules="modules"
            />
        </div>
    </main>
</template>

<script lang="ts" setup>
import { useUserStore } from '~/stores/user'
import { useCourseStore } from '~/stores/course'
import UiOverlay from '~/components/ui/UiOverlay.vue'
import CourseProgram from '~/components/pages/courses/detail/CourseProgram.vue'
import CourseDescription from '~/components/pages/courses/detail/CourseDescription.vue'
import CourseHead from '~/components/pages/courses/detail/CourseHead.vue'

const userStore = useUserStore()
const courseStore = useCourseStore()
const notify = useToast()
const route = useRoute()
const course = ref(null)
const modules = ref(null)
const isLoading = ref(true)

const isAuth = computed(() => userStore.isAuth)

onBeforeMount(async() => {
    try {
        const { data } = await courseStore.getActiveCourse(route.params.id)

        if (!data || !data.course) {
            navigateTo('/courses')
        }

        course.value = data.course
        modules.value = data.modules
    } catch(e) {
        navigateTo('/courses')
    } finally {
        isLoading.value = false
    }
})

const startCourse = async() => {
    try {
        const { message, data } = await courseStore.startCourse(course.value.id)

        if (message) {
            notify.success(message)
        }
        navigateTo(`/courses/${course.value.id}/${data.module_order}/${data.lesson_order}`)
    } catch (e) {
        if (e?.response?.data) {
            notify.error(e.response.data.error || e.response.data.message)
        }
    }
}
</script>
