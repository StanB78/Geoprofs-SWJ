describe('TC-011 – User account wordt aangemaakt door admin', () => {

    beforeEach(() => {
        // Login as admin
        cy.visit('http://127.0.0.1:8000/login');

        cy.get('input[type="email"]').type('emacejkovic@example.com'); // admin account
        cy.get('input[type="password"]').type('password');

        cy.get('button[type="submit"]').click();

        // Verify successful login
        cy.url({ timeout: 10000 }).should('include', 'http://127.0.0.1:8000/dashboard');
    });

    it('navigates to register page via Create New User button', () => {
        // Step 1: Click Create New User
        cy.contains('a', 'Create new User')
            .should('be.visible')
            .click();

        // Verify navigation
        cy.url().should('include', '/register');

        // Verify required fields are visible (5 fields)
        cy.get('input[name="name"]').should('be.visible');
        cy.get('input[name="email"]').should('be.visible');
        cy.get('input[name="password"]').should('be.visible');
        cy.get('input[name="password_confirmation"]').should('be.visible');
        cy.get('select[name="rol"]').should('be.visible');
    });

    it('creates a new user account with selected authority', () => {
        // Go to register page
        cy.visit('http://127.0.0.1:8000/register');

        // Intercept user creation request
        cy.intercept('POST', '**/register').as('createUser');

        // Step 2: Fill in user details
        cy.get('input[name="name"]').type('Test Werknemer');
        cy.get('input[name="email"]').type(`testuser_${Date.now()}@example.com`);
        cy.get('input[name="password"]').type('Password123!');
        cy.get('input[name="password_confirmation"]').type('Password123!');
        cy.get('select[name="rol"]').select('1');

        // Submit form
        cy.get('button[type="submit"]').click();

        // Verify request was successful
        cy.wait('@createUser')
            .its('response.statusCode')
            .should('eq', 302); // Laravel default redirect after success

        // Verify user is redirected or success state is shown
        cy.url().should('include', '/register');
    });

});
