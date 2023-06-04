<template>
    <main>
        <UiOverlay v-if="isLoading" />

        <div v-else>
            <LessonTop
                :title="lessonData.name"
                :subtitle="lessonData.module.course.name"
                :cover="lessonData.module.course.cover"
            />

            <div :class="$style.content">
                <LessonSide
                    :class="$style.side"
                    :description="lessonData.content"
                    :comments="lessonData.comments"
                    :avatar="avatar"
                    @send-comment="sendComment"
                />

                <LessonEditor
                    :class="$style.editor"
                    :layout-code="lessonData.layout_code"
                />
            </div>
        </div>
    </main>
</template>

<script setup>
import { useCourseStore } from '~/stores/course'
import { useUserStore } from '~/stores/user'
import UiOverlay from '~/components/ui/UiOverlay'
import LessonTop from '~/components/pages/lesson/LessonTop.vue'
import LessonSide from '~/components/pages/lesson/LessonSide.vue'
import LessonEditor from '~/components/pages/lesson/editor/LessonEditor.vue'

definePageMeta({
    middleware: ['auth']
})

const userStore = useUserStore()
const courseStore = useCourseStore()
const route = useRoute()
const notify = useToast()

const isLoading = ref(true)
const lessonData = ref(null)

const avatar = computed(() => userStore.user.avatar)

onBeforeMount(async() => {
    try {
        const { data } = await courseStore.getLessonInfo(
            route.params.id,
            route.params.module_id,
            route.params.lesson_id
        )

        lessonData.value = data

        isLoading.value = false
    } catch (e) {
        navigateTo('/courses')
    }
})

const sendComment = async(text) => {
    try {
        const { message, data } = await courseStore.postComment(lessonData.value.id, text)

        notify.success(message)

        lessonData.value.comments = [data.comment, ...lessonData.value.comments]
    } catch (e) {
        if (e?.response?.data) {
            notify.error(e.response.data.error || e.response.data.message)
        }
    }
}
</script>

<style lang="sass" module>
.content
    padding: 20px 20px 0
    display: flex
    height: 76vh

    @include responsive($tablet)
        height: unset
        flex-direction: column

.side
    width: 380px

    @include responsive($tablet)
        width: 100%

.editor
    flex-grow: 1
    margin-left: $offset-xs

    @include responsive($tablet)
        margin-top: $offset-xs
        margin-left: 0
</style>