import { createStore } from 'vuex'

const store = createStore({
    state:{
        appName: 'Prueba',
        nameActivePage: ''
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
    }

})

export default store
