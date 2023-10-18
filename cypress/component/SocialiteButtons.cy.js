import SocialiteButtons from '@/Components/SocialiteButtons.vue'

describe('SocialiteButtons.cy.js', () => {
  // it('renders', () => {
  //   // see: https://on.cypress.io/mounting-vue
  //   cy.mount(SocialiteButtons, {
  //     props: {
  //     },
  //   })
  // })

    it('use with user register screen', () => {
        // see: https://on.cypress.io/mounting-vue
        cy.mount(SocialiteButtons, {
            props: {
                login: false,
            },
        })
        cy.get('[data-cy="socialiteButtonsLabel"]').should('have.text','Register with').and('be.visible')
        // cy.get('[data-cy="socialiteButtonsLabel"]').contains('Register with')
    })

    it('use with user login screen', () => {
        // see: https://on.cypress.io/mounting-vue
        cy.mount(SocialiteButtons, {
            props: {
                login: true,
            },
        })
        cy.get('[data-cy="socialiteButtonsLabel"]').should('have.text','Login with').and('be.visible')
        // cy.get('[data-cy="socialiteButtonsLabel"]').contains('Login with')
    })
})
