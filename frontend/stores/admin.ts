import { defineStore } from 'pinia'
import { News } from '~/types/common'

export const useAdminStore = defineStore('admin', () => {
    const http = useHttp()

    const getUserList = () => {
        return http.get('/api/v1/admin/users').then(({ data }) => data)
    }

    const postNews = (data: Pick<News, 'title' | 'text'>) => {
        return http.post('/api/v1/admin/news', data).then(({ data }) => data)
    }

    const getLanguages = () => {
        return http.get('/api/v1/admin/languages').then(({ data }) => data)
    }

    const postLanguage = (language: string) => {
        return http.post('/api/v1/admin/languages', { language }).then(({ data }) => data)
    }

    const getMyTickets = () => {
        return http.get('/api/v1/admin/tickets/my').then(({ data }) => data)
    }

    const getActiveTickets = () => {
        return http.get('/api/v1/admin/tickets/active').then(({ data }) => data)
    }

    const takeTicket = (id: number) => {
        return http.post(`/api/v1/admin/tickets/take/${id}`).then(({ data }) => data)
    }

    const closeTicket = (id: number) => {
        return http.post(`/api/v1/admin/tickets/resolve/${id}`).then(({ data }) => data)
    }

    return {
        getUserList,
        postNews,
        getLanguages,
        postLanguage,
        getMyTickets,
        getActiveTickets,
        takeTicket,
        closeTicket
    }
})
