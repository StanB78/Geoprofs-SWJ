describe('Login ', () => {

    it('Log succesvol in', () => {

        cy.visit('http://127.0.0.1:8000')
        cy.contains('Log In').click();


        cy.get('input[name="email"]').type('qgoyette@example.org')
        cy.get('input[name="password"]').type('password')
        cy.get('button[type="submit"]').click()


        cy.get('a').contains('verzuim').should('be.visible');

    })

})
