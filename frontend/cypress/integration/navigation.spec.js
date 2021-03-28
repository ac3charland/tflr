import NavBar from '../page/nav-bar'
import HomePage from '../page/home-page'
import SecondaryPage from '../page/secondary-page'

context('Page Navigation', () => {
    beforeEach(() => {
        cy.server()
    })

    it('navigates to proper pages with navbar links', () => {
        cy.visit('/')
        cy.get(HomePage.wrapper)
        cy.compareSnapshot('home')
        cy.scrollTo(0, 100)
        cy.get('.navbar').compareSnapshot('navbar-scrolled')

        cy.get(NavBar.link).eq(0).click()

        cy.url().should('contain', '/secondary')
        cy.get(SecondaryPage.wrapper)
        cy.compareSnapshot('secondary')

        cy.get(NavBar.homeLink).click()

        cy.url().should('contain', '/')
        cy.get(HomePage.wrapper)
    })
})
