export const useAuth = () => {
  const http = useHttp()

  return {
    login: async(userData: { email: string, password: string }) => {
      await http.get('/sanctum/csrf-cookie')

      return await http.post('/login', {
        email: userData.email,
        password: userData.password
      })
    },

    me: async() => {
      return await http.get('/api/v1/user')
    }
  }
}
