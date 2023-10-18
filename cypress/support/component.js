// ***********************************************************
// This example support/component.js is processed and
// loaded automatically before your test files.
//
// This is a great place to put global configuration and
// behavior that modifies Cypress.
//
// You can change the location of this file or turn off
// automatically serving support files with the
// 'supportFile' configuration option.
//
// You can read more here:
// https://on.cypress.io/configuration
// ***********************************************************

// Import commands.js using ES2015 syntax:
import './commands'

// Alternatively you can use CommonJS syntax:
// require('./commands')

// Example use:
// cy.mount(MyComponent)

// import Vuetify from 'vuetify/lib'
// import { VApp } from 'vuetify'
import { createPinia } from 'pinia' // or Vuex
import { createI18n } from 'vue-i18n'
import { mount } from 'cypress/vue'
import { h } from 'vue'

import { pinia, vuetify, appName} from '/resources/js/constants.js'
import i18n from '/i18n/index.js'

// We recommend that you pull this out into a constants
// file that you share with your main.js file.
// const i18nOptions = {
//     locale: 'en',
//     messages: {
//         en: {
//             hello: 'hello!',
//         },
//         ja: {
//             hello: 'こんにちは！',
//         },
//     },
// }

Cypress.Commands.add('mount', (component, ...args) => {
    args.global = args.global || {}
    args.global.plugins = args.global.plugins || []
    args.global.plugins.push(vuetify)
    args.global.plugins.push(pinia)
    args.global.plugins.push(i18n)

    return mount(() => {
        // return h(VApp, {}, component)
    }, ...args)
})
