import '../css/app.css';
import './bootstrap';

import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { createApp, h } from 'vue';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import vuetify from './plugins/vuetify'




const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: async (name) => {
        const pages = import.meta.glob('./Pages/**/*.vue');
        const page = await pages[`./Pages/${name}.vue`]();
    
        // Si la página no define un layout, usa uno por defecto
        page.default.layout = page.default.layout || (await import('./Layouts/AppLayout.vue')).default;
    
        return page;
    },
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
        .use(plugin)
        .use(vuetify) // 👈 agrega Vuetify aquí
        .use(ZiggyVue, Ziggy) // 👈 agrega Ziggy aquí
        .mount(el)
    },
    progress: {
        color: '#4B5563',
    },
});



