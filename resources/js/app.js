import './bootstrap';
import '../css/app.css';

import 'primeicons/primeicons.css'

import {createApp, h} from 'vue';
import {createInertiaApp} from '@inertiajs/vue3';
import {resolvePageComponent} from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from 'ziggy-js';
import {clickoutDirective} from "@/directives.js";
import PrimeVue from "primevue/config";
import Lara from "@/presets/lara";
import ToastService from 'primevue/toastservice';
import Tooltip from 'primevue/tooltip';
import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'
import LaravelPermissionToVueJS from 'laravel-permission-to-vuejs'

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';


createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({el, App, props, plugin}) {
        const app = createApp({render: () => h(App, props)})

        return app
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            .use(PrimeVue, {
                unstyled: true,
                pt: Lara,
            })
            .use(ToastService)
            .directive('tooltip', Tooltip)
            .use(LaravelPermissionToVueJS)
            .component('VueDatePicker', VueDatePicker)
            .provide("can", app.config.globalProperties.can)
            .provide("is", app.config.globalProperties.is)
            .directive('clickout', clickoutDirective)
            .mixin({
                mounted() {
                    // Listen for popstate event (back/forward navigation)
                    window.addEventListener('popstate', () => {
                        // Check if the current path is "/reports"
                        if (window.location.pathname === '/reports') {
                            // Reload the "/reports" page
                            this.$inertia.reload()
                        }
                    })
                }
            })
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
