<template>
    <div class="card">
        <div class="card-header d-flex align-items-center flex-wrap">
            <b>Usuarios</b>
            <div class="ml-auto">
                <button class="btn btn-outline-success" v-on:click="addUser()">Nuevo Usuario <i class="fa-solid fa-user-plus"></i></button>
            </div>
        </div>
        <div class="card-body">
            <user-table/>
        </div>

        <form-modal ref="modal"/>
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
        methods:{
            addUser(){
                this.$refs.modal.showModal('Nuevo usuario')
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>
