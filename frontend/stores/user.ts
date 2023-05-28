import { defineStore } from 'pinia'

interface User {
  id: number | null,
  nickname: string,
  email: string,
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

    const setUserData = (userData: User | null, authState: boolean) => {
        isAuth.value = authState
        user.value = userData
    }

    const logout = () => {
        isAuth.value = false
        user.value = null
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

    return {
        user,
        isAuth,
        setUserData,
        logout,
        getUserInfo,
        updateUserData,
        deleteUser,
        uploadAvatar,
    }
})
