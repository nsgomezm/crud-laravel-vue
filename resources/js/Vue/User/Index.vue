<template>
    <div class="card">
        <div class="card-header d-flex align-items-center flex-wrap">
            <b>Usuarios</b>
            <div class="ml-auto">
                <button class="btn btn-outline-success" v-on:click="showForm()">Nuevo Usuario <i class="fa-solid fa-user-plus"></i></button>
            </div>
        </div>
        <div class="card-body">
            <div v-if="!users">
                sin data
            </div>
            <data-table :data="users" v-on:edit="showForm" v-if="users"/>
        </div>

        <form-modal ref="modal" v-on:new="newRow"/>
    </div>
</template>

<script>
    import DataTable from './components/DataTable'
    import FormModal from './components/FormModal'
    export default {
        components:{
            DataTable,
            FormModal
        },

        computed:{
            users(){ return this.$store.getters['user/getListUsers'] }
        },
        methods:{
            showForm(user = null){
                this.$refs.modal.showModal(`${user ? 'Actualizar' : 'Nuevo'} usuario`, user)
            },
            newRow(user){
                let existsUser = this.users.indexOf(user)
                if(existsUser >= 0){
                    this.users[existsUser] = user
                    return
                }
                this.users.push(user)
            },
        }
    }
</script>

<style lang="scss" scoped>

</style>
