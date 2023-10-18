// import * from '/cypress.env.json'

describe('visit application and user login', () => {
    beforeEach(() => {
        cy.visit(Cypress.env('baseUrl'))
    })

    it('user login', function () {
        let username = Cypress.env('username')
        let password = Cypress.env('password')
        cy.login(username, password)
    })

    it('user registration', function () {
        let username = "shama.sarla@gmail.com"
        let password = "Pawaskar!2"
        cy.visit('/register')
        cy.get('input[id=name]').type("Sharmila Pawaskar")
        cy.get('input[id=email]').type(username)
        cy.get('input[id=password]').type(password)
        cy.get('input[id=password_confirmation]').type(`${password}{enter}`, { log: false })
        cy.url().should('include', '/dashboard')
    })
})
