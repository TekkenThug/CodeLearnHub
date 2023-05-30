import { defineStore } from 'pinia'

export const useCourseStore = defineStore('course', () => {
    const http = useHttp()

    const getCoursesByParams = (params?: { [key: string]: string | boolean }) => {
        return http.get('/api/v1/courses', { params }).then(({ data }) => data)
    }

    return {
        getCoursesByParams
    }
})
