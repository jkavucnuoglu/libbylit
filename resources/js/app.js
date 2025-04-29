import {createInertiaApp, router} from '@inertiajs/vue3'
import {createHead} from '@unhead/vue'
import {resolvePageComponent} from 'laravel-vite-plugin/inertia-helpers'
import {CapoPlugin} from 'unhead'
import {createApp, h} from 'vue'
import {ZiggyVue} from 'ziggy-js'
import './bootstrap'
import '../css/app.css'

const head = createHead({
    plugins: [
        CapoPlugin(),
    ],
})

createInertiaApp({
    resolve: name => resolvePageComponent(`./views/Pages/${name}.vue`, import.meta.glob('./views/Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        const app = createApp({ render: () => h(App, props) });

        // Add $route to globalProperties
        app.config.globalProperties.$router = router; // Assuming `route` is available globally

        return app
            .use(plugin)
            .use(ZiggyVue) // Ensure ZiggyVue is available before using `route`
            .use(head)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
})
