<template>
    <div>
        <div class="container">
            <h1 class="page-title">
                Cоздание курса
            </h1>

            <div :class="$style.stepList">
                <AuthorSection
                    title="1. Общая информация"
                    :class="$style.stepItem"
                >
                    <template #description>
                        Задайте общую информацию по курсу. Выберите название и описание.
                        <br>
                        <br>
                        Выберите доступный язык программирования (к одному курсу на сайте можно привязать только один язык программироваиния).
                        <br>
                        <br>
                        Загрузите обложку курса, которая будет отображаться в выдаче на сайте.
                    </template>

                    <UiInput
                        v-model="name"
                        :class="$style.field"
                        placeholder="Название курса"
                    />

                    <VueMultiselect
                        v-model="language"
                        placeholder="Выберите язык программирования"
                        :searchable="false"
                        :close-on-select="false"
                        :allow-empty="false"
                        :custom-label="nameWithLang"
                        :options="availableLanguages"
                        :class="[$style.field, $style.select]"
                        track-by="id"
                    />

                    <UiTextarea
                        v-model="description"
                        :class="$style.field"
                        placeholder="Описание"
                        :max-length="1500"
                    />

                    <UiUploader
                        :class="[$style.field, $style.uploader]"
                        :is-empty="true"
                        upload-caption="Обложка курса, нажмите чтобы загрузить"
                        @uploaded="(value) => cover = value"
                    />
                </AuthorSection>

                <AuthorSection
                    title="2. Модули курса"
                    :class="$style.stepItem"
                >
                    <template #description>
                        Создайте модули курса. Модули позволяют разделять курс на разделы и содержат в себе уроки.
                        Вы можете дать названия модулям и расположить в нужном порядке.
                        <br>
                        <br>
                        Уроки содержат в себе название, описание, в котором Вы можете давать методический материал.
                        Тестовый код, который будет запускаться для тестирования кода студента.
                        Шаблонный код содержит в себя то, что будет дано студенту в начале урока.
                    </template>
                    <div :class="$style.moduleList">
                        <transition-group name="fade" mode="out-in">
                            <ModuleCreate
                                v-for="(module, index) in modules"
                                :key="module.id"
                                v-model="modules[index]"
                                :order="modules.findIndex(item => item.id === module.id) + 1"
                                :class="$style.moduleItem"
                                @delete="deleteModule(module.id)"
                                @top="move(module.id, 'top')"
                                @bottom="move(module.id, 'bottom')"
                            />
                        </transition-group>
                    </div>

                    <AuthorAddButton
                        caption="Добавить модуль"
                        @click="addModule"
                    />
                </AuthorSection>

                <UiButton
                    :disabled="buttonIsDisabled"
                    :class="$style.saveButton"
                    :is-loading="isLoading"
                    @click="saveCourse"
                >
                    Сохранить
                </UiButton>
            </div>
        </div>
    </div>
</template>

<script lang="ts" setup>
import VueMultiselect from 'vue-multiselect'
import { useCourseStore } from '~/stores/course'

import AuthorSection from '~/components/pages/courses/create/AuthorSection.vue'
import UiTextarea from '~/components/ui/UiTextarea.vue'

import AuthorAddButton from '~/components/pages/courses/create/AuthorAddButton.vue'
import ModuleCreate from '~/components/pages/courses/create/module/ModuleCreate.vue'

const courseStore = useCourseStore()

const language = ref('')
const availableLanguages = ref([])
onBeforeMount(async() => {
    const { data } = await courseStore.getAcceptedLanguagesForCreate()

    availableLanguages.value = data.program_languages
})
const nameWithLang = (data: { name: string }) => data.name

const name = ref('')
const description = ref('')
const cover = ref(null)
const modules = ref([])

const addModule = () => {
    modules.value.push({
        id: modules.value.length,
        title: '',
        lessons: []
    })
}
const deleteModule = (id: number) => {
    modules.value = modules.value.filter(item => item.id !== id)
}
const move = (id: number, direction: string) => {
    const index = modules.value.findIndex(item => item.id === id)
    const indexOfTop = direction === 'top' ? index - 1 : index + 1

    if (index < 0 || index >= modules.value.length || indexOfTop < 0 || indexOfTop >= modules.value.length) {
        return
    }

    const temp = modules.value[index]
    modules.value[index] = modules.value[indexOfTop]
    modules.value[indexOfTop] = temp
}

const buttonIsDisabled = computed(() => {
    if (!modules.value.length) {
        return true
    }

    const emptyModules = !!modules.value.find((module) => {
        const hasEmptyLessons = module.lessons.find((lesson) => {
            for (const key in lesson) {
                if (lesson[key] === '') {
                    return true
                }
            }
        })

        return Boolean(!module.title || !module.lessons.length || hasEmptyLessons)
    })

    return Boolean(
        emptyModules ||
        !language.value ||
        !name.value ||
        !description.value ||
        !cover.value
    )
})

const isLoading = ref(false)
const notify = useToast()
const saveCourse = async() => {
    const object = {
        name: name.value,
        description: description.value,
        program_language: language.value.id,
        modules: modules.value.map((item, index) => {
            return {
                ...item,
                order: index + 1,
                lessons: item.lessons.map((lesson, index) => ({ order: index + 1, ...lesson }))
            }
        })
    }

    isLoading.value = true

    try {
        const { message, data } = await courseStore.createCourse(object)
        const res = await courseStore.uploadCourseCover(data.id, cover.value)

        notify.success(message)
        navigateTo('/profile')
    } catch (e) {
        if (e?.response?.data) {
            notify.error(e.response.data.error || e.response.data.message)
        }
    } finally {
        isLoading.value = false
    }
}
</script>

<style lang="sass" module>
.stepList
    display: flex
    flex-direction: column

.stepItem
    &:not(:first-child)
        padding-top: 70px

        @include responsive($mobile)
            padding-top: 40px

    &:not(:last-child)
        position: relative
        padding-bottom: 70px
        border-bottom: 1px solid $gray-100

        @include responsive($mobile)
            padding-bottom: 40px

.field
    &.uploader
        border-radius: 0
        width: 380px
        height: 220px

        @include responsive($small-mobile)
            width: 100%

    &:not(:last-child)
        margin-bottom: $offset-m

.moduleItem
    padding: $offset-s
    border: 2px solid $blue-main
    border-radius: $r-m
    margin-bottom: $offset-s

.saveButton
    padding: 20px 0
</style>
