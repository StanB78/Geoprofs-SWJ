describe('Ziekmelding ', () => {

    it('maakt een ziekmelding succesvol aan', () => {

        cy.visit('http://127.0.0.1:8000')
        cy.contains('Log In').click();


        cy.get('input[name="email"]').type('qgoyette@example.org')
        cy.get('input[name="password"]').type('password')
        cy.get('button[type="submit"]').click()


        cy.get('a').contains('verzuim').should('be.visible').click();
        cy.get('#melding').type('ben ziek');
        cy.get('#startdatum').type('2027-01-01')
        cy.get('button[type="submit"]').click()

        cy.wait(2000);
        cy.contains('Terug').click();

    })

})
