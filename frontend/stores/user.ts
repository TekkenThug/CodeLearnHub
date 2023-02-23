import { defineStore } from 'pinia'

interface User {
  id: number | null,
  firstName: string,
  secondName: string,
  email: string,
}

export const useUserStore = defineStore('user', () => {
  const http = useHttp()

  const user = ref<User | null>(null)
  const isAuth = ref<boolean>(false)

  const setUserData = (userData: User, authState: boolean) => {
    isAuth.value = authState
    user.value = userData
  }

  const logout = () => {
    isAuth.value = false
    user.value = null
  }

  const getUserInfo = () => {
    http.get('/api/v1/user').then(({ data }) => {
      if (!data) {
        return
      }

      setUserData(data, true)
    })
  }

  return { user, isAuth, setUserData, logout, getUserInfo }
})
