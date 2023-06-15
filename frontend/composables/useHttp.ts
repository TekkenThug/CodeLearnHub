import axios from 'axios'

/**
 * TODO: Replace this on env
 */
const baseURL = 'http://217.25.88.146/'

const httpInstance = axios.create({
    baseURL,
    withCredentials: true,
    headers: {
        Accept: 'application/json'
    }
})

export const useHttp = () => httpInstance
