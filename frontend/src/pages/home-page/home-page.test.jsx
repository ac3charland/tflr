import configureStore from 'redux-mock-store'
import thunk from 'redux-thunk'
import {Provider} from 'react-redux'
import HomePage from './home-page'
import {markHomePageAsVisited} from '../../actions/mark-home-page'

const mockStore = configureStore([thunk])
const cb = 'home'

jest.mock('../../actions/mark-home-page', () => ({
    markHomePageAsVisited: jest.fn(() => ({type: 'script'})),
}))

describe('HomePage', () => {
    let props, render, mockState, store

    beforeEach(() => {
        mockState = {
            app: {
                homePageVisted: true,
            },
        }

        store = mockStore(mockState)

        render = (changedProps = {}) => mount(<Provider store={store}><HomePage {...props} {...changedProps} /></Provider>)
    })

    afterEach(() => {
        jest.clearAllMocks()
    })

    it('displays if home page has been visited', () => {
        const component = render()
        expect(component.find(`.${cb}`).text()).toEqual('Long home page!(Footer is below the fold)This page has been marked as visited by Redux.')
    })

    it('displays if home page has not been visited', () => {
        mockState.app.homePageVisted = false
        const component = render()
        expect(component.find(`.${cb}`).text()).toEqual('Long home page!(Footer is below the fold)This page has not been marked as visited by Redux.')
    })

    it('marks home page as visited on mount', () => {
        render()
        expect(markHomePageAsVisited).toHaveBeenCalledTimes(1)
    })
})
