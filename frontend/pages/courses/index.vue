<template>
    <main class="page">
        <CoursesSearch @search="setSearchValue" />

        <CoursesSort
            :class="$style.sorting"
            @change="setSort"
        />

        <CourseList
            :class="$style.list"
            :is-loading="isLoading"
            :courses="courses"
        />
    </main>
</template>

<script lang="ts" setup>
import CoursesSearch from '~/components/pages/courses/CoursesSearch.vue'
import CoursesSort from '~/components/pages/courses/CoursesSort.vue'
import CourseList from '~/components/pages/courses/CoursesList.vue'
import { useCourseStore } from '~/stores/course'

const courseStore = useCourseStore()
const searchValue = ref('')
const courses = ref([])
const isLoading = ref<boolean>(false)
const sort = ref<{ value: string, desc: string }>({
    value: 'rate',
    desc: 'desc'
})
const setSearchValue = (value: string) => {
    searchValue.value = value
    getCourses()
}
const setSort = (value: typeof sort.value) => {
    sort.value = value
    getCourses()
}

const getCourses = async() => {
    isLoading.value = true

    try {
        const { data } = await courseStore.getCoursesByParams({
            search: searchValue.value,
            sort: sort.value.value,
            desc: sort.value.desc
        })
        courses.value = data.courses
    } finally {
        isLoading.value = false
    }
}

onMounted(async() => {
    await getCourses()
})
</script>

<style lang="sass" module>
.sorting
    margin-top: $offset-m

.list
    margin-top: $offset-xxl
</style>
