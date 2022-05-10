<template>
    <div class="card">
        <div class="card-header d-flex align-items-center flex-wrap">
            <b>Usuarios</b>
            <div class="ml-auto">
                <button class="btn btn-outline-success" v-on:click="addUser()">Nuevo Usuario <i class="fa-solid fa-user-plus"></i></button>
            </div>
        </div>
        <div class="card-body">
            <user-table :data="users" v-on:delete="removedUser"/>
        </div>

        <form-modal ref="modal" v-on:new="newRow"/>
    </div>
</template>

<script>
    import UserTable from './components/UserTable'
    import FormModal from './components/FormModal'
    export default {
        components:{
            UserTable,
            FormModal
        },
        data(){
            return{
                users: null
            }
        },
        created(){
            this.getData()
        },
        methods:{
            async getData(){
                await axios
                    .get('/api/users')
                    .then(res => {
                        this.users = res.data
                    })
                    .catch(error => {
                        Swal.fire('Ops..!', 'Ocurrio un error', 'error')
                    })
                    .finally(() => {
                        $(document).ready( function () {
                            $('#table').DataTable();
                        });
                        this.load = true
                    })
            },
            addUser(){
                this.$refs.modal.showModal('Nuevo usuario')
            },
            newRow(user){
                this.users.push(user)
            },
            removedUser(user){
                this.users.splice( this.users.indexOf(user), 1)
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>
