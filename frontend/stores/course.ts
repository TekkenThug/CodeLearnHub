import { defineStore } from 'pinia'

export const useCourseStore = defineStore('course', () => {
    const http = useHttp()

    const popularCourses = ref([])

    const getLandingCourses = async() => {
        const { data } = await http.get('/api/v1/courses/landing').then(({ data }) => data)

        popularCourses.value = data.courses
    }

    const getCoursesByParams = (params?: { [key: string]: string | boolean }) => {
        return http.get('/api/v1/courses', { params: { ...params, is_active: true } }).then(({ data }) => data)
    }

    const getCourse = (id: number | string) => {
        return http.get(`/api/v1/courses/${id}`).then(({ data }) => data)
    }

    const getActiveCourse = (id: number | string) => {
        return http.get(`/api/v1/courses/active/${id}`).then(({ data }) => data)
    }

    const getAcceptedLanguagesForCreate = () => {
        return http.get('/api/v1/program-languages/accepted').then(({ data }) => data)
    }

    const createCourse = (data) => {
        return http.post('/api/v1/courses', data).then(({ data }) => data)
    }

    const getMyCourses = () => {
        return http.get('/api/v1/courses/my').then(({ data }) => data)
    }

    const getMyAuthoredCourses = () => {
        return http.get('/api/v1/courses/authored').then(({ data }) => data)
    }

    const startCourse = (courseId: string | number) => {
        return http.post('/api/v1/courses/record', { id: courseId }).then(({ data }) => data)
    }

    const getLessonInfo = (
        courseId: string | number,
        moduleOrder: string | number,
        lessonOrder: string | number
    ) => {
        return http.get('/api/v1/lessons', {
            params: { courseId, moduleOrder, lessonOrder, forTeach: true }
        }).then(({ data }) => data)
    }

    const postComment = (lessonId: string | number, text: string) => {
        return http.post('/api/v1/comments', { lessonId, text }).then(({ data }) => data)
    }

    return {
        popularCourses,
        getLandingCourses,
        getCourse,
        getActiveCourse,
        getCoursesByParams,
        getAcceptedLanguagesForCreate,
        createCourse,
        getMyCourses,
        getMyAuthoredCourses,
        startCourse,
        getLessonInfo,
        postComment
    }
})
