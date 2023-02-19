import axios from 'axios'

const baseURL = (useRuntimeConfig()).baseURL
const httpInstance = axios.create({
  baseURL,
  withCredentials: true,
  headers: {
    Accept: 'application/json'
  }
})

export const useHttp = () => httpInstance
