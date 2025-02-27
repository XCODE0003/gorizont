import '../css/app.css';
import './bootstrap';

import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { createApp, h } from 'vue';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import PrimeVue from 'primevue/config'
import { createPinia } from 'pinia'
import axios from './axios';
import Aura from '@primeuix/themes/aura';
import { definePreset } from '@primeuix/themes';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

const CustomTheme = definePreset(Aura, {
    semantic: {
        
        colorScheme: {
            dark: {
                primary: {
                    color: '#fff',
                    inverseColor: '#ffffff',
                    hoverColor: '#fff',
                },
             
            
            }
        }
    },
    components: {
        editor: {
            colorScheme: {
                dark: {
                    root: {
                    },
                    toolbar: {
                    },
                    content: {
                    }
                }
            }
        },
        fileupload: {
            colorScheme: {
                dark: {
                    root: {
                        background: 'transparent',
                    },
                    buttonbar: {
                    }
                }
            }
        }
    }
});

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob('./Pages/**/*.vue'),
        ),
    setup({ el, App, props, plugin }) {
        const app = createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)  
            .use(PrimeVue, {
                theme: {
                    preset: CustomTheme,
                    options: {
                        darkModeSelector: '.dark-mode',
                    }
                },
            })
            .use(createPinia())
            .mount(el);

        window.axios = axios;
        
        // Добавляем класс темной темы к корневому элементу при инициализации
        document.documentElement.classList.add('dark-mode');

        return app;
    },
    progress: {
        color: '#29292B',
    },
});
