// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  ssr: false,
  typescript: {
    strict: true
  },
  app: {
    head: {
      link: [
        { rel: 'stylesheet', href: 'https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600&display=swap' }
      ]
    }
  },

  css: ['normalize.css', '@splidejs/vue-splide/css'],

  modules: [
    ['nuxt-icon', { size: '24px' }]
  ],

  plugins: [
    '@/plugins/vue-splider'
  ],

  vite: {
    css: {
      preprocessorOptions: {
        sass: {
          additionalData: '@use "@/assets/sass/_global.sass" as *'
        }
      }
    }
  }
})
