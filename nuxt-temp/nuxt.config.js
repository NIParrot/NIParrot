const webpack = require("webpack");

export default {
    // Disable server-side rendering (https://go.nuxtjs.dev/ssr-mode)
    generate: {
        dir: '../spa'
    },
    router: {
        base: '/spa/'
    },
    mode: 'spa',

    // Global page headers (https://go.nuxtjs.dev/config-head)
    head: {
        title: 'y',
        meta: [
            { charset: 'utf-8' },
            { name: 'viewport', content: 'width=device-width, initial-scale=1' },
            { hid: 'description', name: 'description', content: '' }
        ],
        link: [
            { rel: 'icon', type: 'image/x-icon', href: '/favicon.ico' }
        ],
        script: [
            { src: '@/plugins/chart.js' }
        ]
    },
    pwa: {
        meta: {
            charset: 'utf-8',
            viewport: 'width=device-width, initial-scale=1',
        },
        manifest: {
            name: 'hisham',
            lang: 'en',
            display: 'standalone',
            description: 'hisham Pwa NUxt'
        }
    },


    // Global CSS (https://go.nuxtjs.dev/config-css)
    css: [
        "~/node_modules/bootstrap/dist/css/bootstrap.css",
        "~/plugins/DataTables/datatables.min.css",
        "~/assets/font-awesome/css/font-awesome.css",
        "~/assets/css/animate.css",
        "~/assets/css/style.css"
    ],

    // Plugins to run before rendering page (https://go.nuxtjs.dev/config-plugins)
    plugins: [
        // '@/plugins/chart.js'
        "~/plugins/bootstrap.min.js",
        "~/plugins/js.cookie.min.js",
        "~/plugins/metismenu.js",
        "~/plugins/slimscroll.js",
        "~/plugins/inspinia.js",
        { src: '~/plugins/DataTables/datatables.min.js', mode: 'client' },
    ],

    // Auto import components (https://go.nuxtjs.dev/config-components)
    components: true,

    // Modules for dev and build (recommended) (https://go.nuxtjs.dev/config-modules)
    buildModules: [],

    // Modules (https://go.nuxtjs.dev/config-modules)
    modules: [
        // https://go.nuxtjs.dev/axios
        '@nuxtjs/axios',
        // https://go.nuxtjs.dev/pwa
        '@nuxtjs/pwa',
    ],


    // Axios module configuration (https://go.nuxtjs.dev/config-axios)
    axios: {},

    // Build Configuration (https://go.nuxtjs.dev/config-build)
    build: {
        vendor: ["jquery", "bootstrap"],
        plugins: [
            new webpack.ProvidePlugin({
                $: "jquery"
            })
        ],
        /*
         ** Run ESLint on save
         */
        extend(config, { isDev, isClient }) {
            if (isDev && isClient) {
                config.module.rules.push({
                    enforce: "pre",
                    test: /\.(js|vue)$/,
                    loader: "eslint-loader",
                    exclude: /(node_modules)/
                });
            }
        }
    }
}