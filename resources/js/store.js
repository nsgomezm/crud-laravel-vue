import { createStore } from 'vuex'
import StoreUser from './store/users'
const store = createStore({
    state:{
        appName: 'Prueba',
        nameActivePage: '',
        iva: 0.19
    },
    getters:{
        nameCurrentPage (state) {
            return `${state.appName} ${ state.nameActivePage == '' ? '' : '| '+ state.nameActivePage}`
        },
    },
    mutations:{
        changeNameActivePage (state, newName) {
            state.nameActivePage = newName ?? ` - ${newName}`
        },
    },
    actions:{
        setNameActivePage ({ commit }, currentName) {
            commit('changeNameActivePage', currentName)
        },
    },

    modules:{
        user: StoreUser
    }

})

export default store
