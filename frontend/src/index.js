import React from 'react'
import ReactDOM from 'react-dom'
import {Provider} from 'react-redux'
import './index.scss'
import * as serviceWorker from './serviceWorker'
import {Route, BrowserRouter as Router, Switch} from 'react-router-dom'
import NavBar from './components/nav-bar/nav-bar'
import Footer from './components/footer/footer'
import HomePage from './pages/home-page/home-page'
import SecondaryPage from './pages/secondary-page/secondary-page'
import {NAVBAR_HEIGHT, SECONDARY_PAGE_URL} from './utils/constants'
import makeStore from './store'

const store = makeStore()

ReactDOM.render(
  <Provider store={store}>
    <React.StrictMode>
      <Router>
        <div className='content-wrapper' style={{minHeight: `calc(100vh - ${NAVBAR_HEIGHT + 2}rem)`}}>
          <NavBar />
          <div className='flex' style={{minHeight: `calc(100vh - ${NAVBAR_HEIGHT + 2}rem)`, marginTop: `${NAVBAR_HEIGHT + 2}rem`}}>
            <div className='page-wrapper'>
              <Switch>
                <Route exact path='/' component={HomePage} />
                <Route exact path={SECONDARY_PAGE_URL} component={SecondaryPage} />
              </Switch>
            </div>
            <Footer />
          </div>
        </div>
      </Router>
    </React.StrictMode>
  </Provider>,
  document.getElementById('root')
)

// If you want your app to work offline and load faster, you can change
// unregister() to register() below. Note this comes with some pitfalls.
// Learn more about service workers: https://bit.ly/CRA-PWA
serviceWorker.unregister()
