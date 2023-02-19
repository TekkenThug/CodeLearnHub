import Toast from 'vue-toastification'

export default defineNuxtPlugin((nuxtApp) => {
  nuxtApp.vueApp.use(Toast, {
    transition: 'Vue-Toastification__fade',
    maxToasts: 10,
    newestOnTop: true,
    position: 'bottom-right'
  })
})
