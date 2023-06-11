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
            title: 'CodeLearnHub',

            link: [
                { rel: 'stylesheet', href: 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Unbounded:wght@300;400;500;600&display=swap' },
                { rel: 'icon', type: 'image/x-icon', href: '/favicon/favicon.ico' }
            ]
        },

        pageTransition: { name: 'fade', mode: 'out-in' }
    },

    css: [
        'normalize.css',
        'vue-final-modal/style.css',
        '@splidejs/vue-splide/css',
        'vue-toastification/dist/index.css',
        '~/assets/css/vue-multiselect.min.css'
    ],

    modules: [
        '@nuxtjs/svg-sprite',
        'nuxt-icon'
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
