import React, {useEffect} from 'react'
import './home-page.scss'
import {useSelector, useDispatch} from 'react-redux'
import {markHomePageAsVisited} from '../../actions/mark-home-page'

const cb = 'home'

const HomePage = () => {
    const dispatch = useDispatch()
    const visited = useSelector(state => state.app.homePageVisted)

    useEffect(() => {
        dispatch(markHomePageAsVisited())
    }, [])

    return (
        <div className={cb}>
            <h1 className={`${cb}__heading`}>Long home page!</h1>
            <p>(Footer is below the fold)</p>
            <p>This page has {!visited ? 'not ' : ''}been marked as visited by Redux.</p>
        </div>
    )
}

export default HomePage
