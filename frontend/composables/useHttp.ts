import axios from 'axios'

/**
 * TODO: Replace this on env
 */
const baseURL = 'http://localhost:8000'

const httpInstance = axios.create({
    baseURL,
    withCredentials: true,
    headers: {
        Accept: 'application/json'
    }
})

export const useHttp = () => httpInstance
