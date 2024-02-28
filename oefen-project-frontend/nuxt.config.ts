// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
    css: [
        '~/assets/main.css',
    ],
    devtools: {enabled: true},
    modules: [
        '@pinia/nuxt',
        "@nuxtjs/tailwindcss",
        '@pinia-orm/nuxt'
    ],
})