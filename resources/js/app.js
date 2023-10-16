import './bootstrap';
import '../css/app.css';
import './yatranslate.js';

import ru from './Language/ru.json';
import tur from './Language/tur.json';
import en from './Language/en.json';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
import VueGoogleMaps from '@fawmi/vue-google-maps'

const imageServiceUrl = 'http://159.253.23.123:7777/image.evon.service/';

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, app, props, plugin }) {
        const VueApp = createApp({ render: () => h(app, props) })

        VueApp.config.globalProperties.globalToken = '6f8be2a8db029ec86bd40833acbbd0c5'

        VueApp.config.globalProperties.$ru = ru;
        VueApp.config.globalProperties.$en = en;
        VueApp.config.globalProperties.$tur = tur;
        VueApp.config.globalProperties.$service = imageServiceUrl;

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
