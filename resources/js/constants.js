import './bootstrap';
import '../css/app.css';

// Vuetify
import 'vuetify/styles'
import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'
// Icons sets
import { aliases, mdi } from 'vuetify/iconsets/mdi-svg'
import { fa } from 'vuetify/iconsets/fa'
// Internationalization
import { createVueI18nAdapter } from 'vuetify/locale/adapters/vue-i18n'
import { useI18n } from 'vue-i18n'
import i18n from '../../i18n/index.js'

export const vuetify = createVuetify({
    components,
    directives,
    icons: {
        defaultSet: 'mdi',
        aliases,
        sets: {
            mdi,
            fa,
        },
    },
    locale: {
        adapter: createVueI18nAdapter({ i18n, useI18n }),
    },
})

// Pinia Store
import { createPinia } from 'pinia'
export const pinia = createPinia()

export const appName = import.meta.env.VITE_APP_NAME || 'Laravel';
