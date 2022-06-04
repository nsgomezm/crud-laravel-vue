import axios from "axios"
import Swal from "sweetalert2"

export default {
    namespaced: true,
    state: {
        users: null,
    },
    getters:{
        getListUsers: (state) => {
            return state.users
        },
    },
    mutations:{
        setListUsers(state, users){
            state.users = users
        },
        delete(state, user){
            let index = state.users.indexOf(user)
            state.users.splice(index, 1)
        }
    },
    actions:{
        async getUsers({commit}){
            await axios
                .get('/api/users')
                .then(res => {
                    commit('setListUsers', res.data)
                })
                .catch(error => {
                    console.log(error)
                    Swal.fire('Ops..!', 'Ocurrio un error', 'error')
                })
        },

        async delete({commit}, user){
            await axios
                .delete(`/api/users/${user.id}`)
                .then(res => {
                    if(res.data.deleted){
                        Swal.fire('', 'Se elimino correctamente', 'success')
                        commit('delete', user)
                        return
                    }
                    Swal.fire('Ops...!', 'No se pudo eliminar', 'error')
                })
                .catch(error => {
                    Swal.fire('Ops...!', 'Ocurrio un error', 'error')
                    console.log(error)
                })
        }
    }
}
