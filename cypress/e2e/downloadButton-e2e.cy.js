describe('Download PDFs from melding page', () => {

    beforeEach(() => {
        // Visit login page
        cy.visit('http://127.0.0.1:8000/login');

        // Fill in login form
        cy.get('input[type="email"]').type('emacejkovic@example.com');
        cy.get('input[type="password"]').type('password');

        // Submit login
        cy.get('button[type="submit"]').click();

        // Assert login success (dashboard or redirect)
        cy.url({ timeout: 20000 }).should('include', '/dashboard');

        // Go to melding page
        cy.visit('http://127.0.0.1:8000/melding');
    });

    it('downloads the Verzuim log PDF', () => {
        cy.intercept('GET', '**/melding/pdf').as('verzuimPdf');

        cy.contains('a', 'Download Verzuim log')
            .should('be.visible')
            .click();

        cy.wait('@verzuimPdf')
            .its('response.statusCode')
            .should('eq', 200);
    });

    it('downloads the Werknemer lijst PDF', () => {
        cy.intercept('GET', '**/werknemers/pdf').as('werknemersPdf');

        cy.contains('a', 'Download Werknemer lijst')
            .should('be.visible')
            .click();

        cy.wait('@werknemersPdf')
            .its('response.statusCode')
            .should('eq', 200);
    });
});
