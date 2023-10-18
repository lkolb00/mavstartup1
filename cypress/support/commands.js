// ***********************************************
// This example commands.js shows you how to
// create various custom commands and overwrite
// existing commands.
//
// For more comprehensive examples of custom
// commands please read more here:
// https://on.cypress.io/custom-commands
// ***********************************************
//
//
// -- This is a parent command --
// Cypress.Commands.add('login', (email, password) => { ... })
//
//
// -- This is a child command --
// Cypress.Commands.add('drag', { prevSubject: 'element'}, (subject, options) => { ... })
//
//
// -- This is a dual command --
// Cypress.Commands.add('dismiss', { prevSubject: 'optional'}, (subject, options) => { ... })
//
//
// -- This will overwrite an existing command --
// Cypress.Commands.overwrite('visit', (originalFn, url, options) => { ... })

Cypress.Commands.add('login', (email, password) => {
    cy.session(
        username,
        () => {
            cy.visit('/login')
            cy.get('input[type=email]').type(email)
            cy.get('input[type=password]').type(`${password}{enter}`, { log: false })
            cy.url().should('include', '/dashboard')
            // cy.get('h1').should('contain', username)
        },
        {
            // validate: () => {
            //     cy.getCookie('your-session-cookie').should('exist')
            // },
        }
    )
})
