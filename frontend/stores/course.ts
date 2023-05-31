import { defineStore } from 'pinia'

export const useCourseStore = defineStore('course', () => {
    const http = useHttp()

    const getCoursesByParams = (params?: { [key: string]: string | boolean }) => {
        return http.get('/api/v1/courses', { params }).then(({ data }) => data)
    }

    const getAcceptedLanguagesForCreate = () => {
        return http.get('/api/v1/program-languages/accepted').then(({ data }) => data)
    }

    const createCourse = (data) => {
        return http.post('/api/v1/courses', data).then(({ data }) => data)
    }

    return {
        getCoursesByParams,
        getAcceptedLanguagesForCreate,
        createCourse,
    }
})
