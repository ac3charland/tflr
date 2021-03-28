import React, {useState, useEffect} from 'react'
import './nav-bar.scss'
import {SECONDARY_PAGE_URL} from '../../utils/constants'

const cb = 'navbar'

const NavBar = () => {
    const [menuOpen, setMenuOpen] = useState(false)
    const menuCSS = menuOpen ? 'open' : 'closed'
    const menuIcon = menuOpen ? 'fa-times' : 'fa-bars'
    const [navBarActive, setNavBarActive] = useState(false)

    useEffect(() => {
        const changeBackground = () => {
            const navBarChangeHeight = 20
            if (window.scrollY >= navBarChangeHeight && !navBarActive) {
                setNavBarActive(true)
            }
            else if (window.scrollY < navBarChangeHeight && navBarActive) {
                setNavBarActive(false)
            }
        }
        window.addEventListener('scroll', changeBackground, {passive: true})

        return () => window.removeEventListener('scroll', changeBackground)
    }, [navBarActive])

    return (
        <div id='nav-bar' className={`${cb} ${navBarActive ? 'active' : ''}`}>
            <a className={`${cb}__home`} href='/'><h1 className={`${cb}__heading`}>[CHANGE_ME_SITE_TITLE]</h1></a>
            <div className={`${cb}__links ${menuCSS}`}>
                <button className={`icon ${menuCSS}`} onClick={() => setMenuOpen(!menuOpen)}><i className={`fa ${menuIcon}`}></i></button>
                <a id={'secondary-link'} className={`${cb}__link ${menuCSS}`} href={SECONDARY_PAGE_URL}>CHANGE_ME SECONDARY_LINK</a>
            </div>
        </div>
    )
}

export default NavBar
