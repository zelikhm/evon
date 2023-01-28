import './bootstrap';
import '../css/app.css';
import './yatranslate.js'

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
import VueGoogleMaps from '@fawmi/vue-google-maps'

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, app, props, plugin }) {
        const VueApp = createApp({ render: () => h(app, props) })

        VueApp.config.globalProperties.globalToken = '6f8be2a8db029ec86bd40833acbbd0c5'

        VueApp.use(plugin)
              .use(VueGoogleMaps, {
                  load: {
                      key: 'AIzaSyBo8Ws9ujugchMacJ3BNAvGWTn6b1cmtJ4',
                      language: 'ru'
                  }
              })
              .use(ZiggyVue, Ziggy)
              .mount(el);
    },
});

InertiaProgress.init({ color: '#4B5563' });
