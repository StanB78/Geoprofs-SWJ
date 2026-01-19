describe('TC-013 – User kan eenvoudig uitloggen', () => {

    beforeEach(() => {
        // Login as user
        cy.visit('http://127.0.0.1:8000/login');

        cy.get('input[type="email"]').type('emacejkovic@example.com');
        cy.get('input[type="password"]').type('password');
        cy.get('button[type="submit"]').click();

        // Wait for dashboard URL
        cy.url({ timeout: 10000 }).should('include', '/dashboard');
    });

    it('displays the user name on the dashboard', () => {
        cy.get('.auth-username', { timeout: 10000 }) // add timeout
            .should('be.visible');
    });

    it('logs out the user when clicking the logout button', () => {
        // Wait for the logout button to exist and be visible
        cy.get('form[action="http://127.0.0.1:8000/logout"] button[type="submit"]', { timeout: 10000 })
            .should('exist')
            .should('be.visible')
            .click();

        // Verify user is redirected to welcome page
        cy.url({ timeout: 10000 }).should('eq', 'http://127.0.0.1:8000/');
    });

});
