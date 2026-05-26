describe('test de l\'inscription jusqu\'au tirage au sort du film', () => {
    beforeEach(() => {
        cy.fixture('usersLibrary').as('userData');
        cy.visit('http://localhost/popcornChaos/')
    })
    cy.get('name').should('have.text', 'jean')
})