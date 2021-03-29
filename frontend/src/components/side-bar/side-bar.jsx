import React, {useState} from 'react'
import moment from 'moment'

import {ALEX_PORTFOLIO_URL} from '../../utils/constants'
import {Link} from 'react-router-dom'

import './side-bar.scss'


const cb = 'sidebar'

const SideBar = () => {

    const [open, setOpen] = useState(true)
    return (
        <div className={`${cb} ${open ? '' : `${cb}__closed`}`}>
            <Link className={`${cb}__home`} to={'/'}>
                <h1 className={`${cb}__site-header`}>
                    <span>{open ? 'Try' : 'T'}</span>
                    <span>{open ? 'Fail' : 'F'}</span>
                    <span>{open ? 'Learn' : 'L'}</span>
                    <span>{open ? 'Repeat' : 'R'}</span>
                </h1>
            </Link>
            <button className={`${cb}__button`} onClick={() => setOpen(!open)}>{open ? '<' : '>'}</button>
            <footer className={`${cb}__footer`}>
                <div>Copyright &copy; {moment().format('YYYY')} <a href={ALEX_PORTFOLIO_URL}>Alex Charland</a></div>
            </footer>
        </div>
    )
}

export default SideBar