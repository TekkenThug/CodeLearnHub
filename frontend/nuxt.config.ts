// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  ssr: false,

  typescript: {
    strict: true
  },

  runtimeConfig: {
    public: {
      baseURL: process.env.NODE_ENV === 'production' ? process.env.PROD_API_URL : process.env.DEV_API_URL
    }
  },

  app: {
    head: {
      title: 'eDex',

      link: [
        { rel: 'stylesheet', href: 'https://fonts.googleapis.com/css2?family=PT+Sans:wght@400;700&display=swap' }
      ]
    }
  },

  css: [
    'normalize.css',
    'vue-final-modal/style.css',
    '@splidejs/vue-splide/css',
    'vue-toastification/dist/index.css'
  ],

  modules: ['nuxt-icon'],

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
