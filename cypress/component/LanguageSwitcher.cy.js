import { mount } from '@vue/test-utils'
import { createI18n } from 'vue-i18n'
import pluralRules from "/i18n//rules/pluralization"
import numberFormats from "/i18n//rules/numbers.js"
import datetimeFormats from "/i18n//rules/datetime.js"
import LanguageSwitcher from '@/Components/LanguageSwitcher.vue'
import vuetifyEn from 'vuetify/lib/locale/en'
import en from "/i18n/locales/en.json"


describe('LanguageSwitcher.vue', () => {
    it('i18n', () => {
        const messages = {
            en: {
                ...vuetifyEn,
                ...en,
                dataTable: {
                    pageText: '{0} - {1} out of {2}',
                },
            }
        }

        const i18n = new createI18n({
            locale: import.meta.env.VITE_DEFAULT_LOCALE,
            fallbackLocale: import.meta.env.VITE_FALLBACK_LOCALE,
            legacy: false,
            globalInjection: true,
            messages: messages,
            runtimeOnly: false,
            pluralRules,
            numberFormats,
            datetimeFormats
        })

        const wrapper = mount(LanguageSwitcher, {
            global: {
                plugins: [i18n]
            }
        })

        // expect(wrapper.vm.t).toBeTruthy()
    })
})
