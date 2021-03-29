import React from 'react'
import ReactDOM from 'react-dom'
import {Provider} from 'react-redux'
import {Route, BrowserRouter as Router, Switch} from 'react-router-dom'

import * as serviceWorker from './serviceWorker'
import makeStore from './store'

import SideBar from './components/side-bar/side-bar'
import LatestPostsPage from './pages/latest-posts-page/latest-posts-page'

import './index.scss'

const store = makeStore()

ReactDOM.render(
  <Provider store={store}>
    <React.StrictMode>
      <Router>
        <div className='flex'>
          <SideBar />
          <div className='main-wrapper'>
            <Switch>
              <Route exact path='/' component={LatestPostsPage} />
            </Switch>
          </div>
        </div>
      </Router>
    </React.StrictMode>
  </Provider>,
  document.getElementById('root')
)

serviceWorker.register()
