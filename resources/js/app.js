import {createInertiaApp} from '@inertiajs/vue3'
import {createHead} from '@unhead/vue'
import {resolvePageComponent} from 'laravel-vite-plugin/inertia-helpers'
import {CapoPlugin} from 'unhead'
import {createApp, h} from 'vue'
import {ZiggyVue} from 'ziggy-js'
import './bootstrap'
import '../css/app.css'

import pinia from "@/store/index.js";

const head = createHead({
    plugins: [
        CapoPlugin(),
    ],
})

createInertiaApp({
    resolve: name => resolvePageComponent(`./views/Pages/${name}.vue`, import.meta.glob('./views/Pages/**/*.vue')),
    setup({el, App, props, plugin}) {
        return createApp({render: () => h(App, props)})
            .use(plugin)
            .use(ZiggyVue)
            .use(head)
            .use(pinia)
            .mount(el)
    },
    progress: {
        color: '#4B5563',
    },
})
