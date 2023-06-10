import { defineStore } from 'pinia'

export const useAdminStore = defineStore('admin', () => {
    const http = useHttp()

    const getUserList = () => {
        return http.get('/api/v1/admin/users').then(({ data }) => data)
    }

    return {
        getUserList
    }
})
