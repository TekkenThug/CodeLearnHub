import { defineStore } from 'pinia'
import { News } from '~/types/common'

type Role = 'student' | 'admin' | 'author'

interface User {
    id: number | null,
    nickname: string,
    email: string,
    roles: Role[],
    avatar?: string,
}

interface UpdateUser {
    email?: string,
    nickname?: string,
    password?: string
}

export const useUserStore = defineStore('user', () => {
    const http = useHttp()

    const user = ref<User | null>(null)
    const isAuth = ref<boolean>(false)

    const isAuthor = () => user?.value?.roles.includes('author')
    const isAdmin = () => user?.value?.roles.includes('admin')

    const setUserData = (userData: User | null, authState: boolean) => {
        isAuth.value = authState
        user.value = userData

        if (userData?.roles && user.value) {
            // @ts-ignore
            user.value.roles = userData.roles.map(role => role.name)
        }
    }

    const logout = async() => {
        await http.post('/logout')

        setTimeout(() => {
            isAuth.value = false
            user.value = null
        }, 300)
    }

    const getUserInfo = () => {
        return http.get('/api/v1/user').then(({ data }) => {
            if (!data) {
                return
            }

            setUserData(data, true)
        }).catch(() => null)
    }

    const updateUserData = (data: UpdateUser) => {
        if (!user.value) {
            return
        }

        return http.put(`/api/v1/users/${user.value.id}`, data).then(({ data }) => data)
    }

    const uploadAvatar = (avatar: Blob) => {
        if (!user.value) {
            return
        }

        const form = new FormData()

        form.append('image', avatar)
        // @ts-ignore
        form.append('id', user.value.id)

        return http.post('/api/v1/upload/avatar', form, {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        }).then(({ data }) => data)
    }

    const deleteUser = () => {
        if (!user.value) {
            return
        }

        return http.delete(`/api/v1/users/${user.value.id}`).then(({ data }) => {
            setUserData(null, false)
            return data
        })
    }

    const getNews = async() => {
        const { data } = await http.get('/api/v1/news').then(({ data }) => data)

        return data.news.map((item: News) => ({
            ...item,
            text: JSON.parse(item.text),
            added_at: new Date(item.added_at).toLocaleDateString('ru-RU', {
                hour: 'numeric',
                minute: 'numeric'
            })
        }))
    }

    return {
        user,
        isAuth,
        isAdmin,
        isAuthor,
        setUserData,
        logout,
        getUserInfo,
        updateUserData,
        deleteUser,
        uploadAvatar,
        getNews
    }
})
