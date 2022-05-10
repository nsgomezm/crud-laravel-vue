<template>
    <!-- Modal -->
    <div class="modal fade" id="FormModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="FormModalLabel">{{ titleModal }}</h5>
                    <button type="button" class="close" v-on:click="closeModal()" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="overlay" v-if="!load">
                        <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                    </div>
                    <backend-errors :errors="errors"/>

                    <form v-on:submit.prevent="store()">
                        <div class="form-floating mb-3">
                            <input autocomplete="false" type="number" class="form-control" id="cedula" placeholder="123456789" v-model="form.cedula">
                            <label for="cedula">Cedula</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input autocomplete="false" type="text" class="form-control" id="name" placeholder="Juanito Perez" v-model="form.name">
                            <label for="name">Nombre</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input autocomplete="false" type="email" class="form-control" id="email" placeholder="Juanito Perez" v-model="form.email">
                            <label for="email">Correo electronico</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input autocomplete="false" type="password" class="form-control" id="password" placeholder="Juanito Perez" v-model="form.password">
                            <label for="password">Contraseña</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input autocomplete="false" type="password" class="form-control" id="password_confirm" placeholder="Juanito Perez" v-model="form.password_confirm">
                            <label for="password_confirm">Confirmar Contraseña</label>
                        </div>
                        <input type="submit" class="d-none" id="submit">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" v-on:click="closeModal()">Close</button>
                    <label for="submit" :class="`btn btn-primary ${loading ? 'disabled' : ''}`" :disabled="loading">{{ loading ? 'Guardando...' : 'Guardar' }}</label>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                titleModal: null,
                load: false,
                loading: false,
                errors: null,
                form: {
                    name: null,
                    email: null,
                    password: null,
                    password_confirm:null
                }
            }
        },
        mounted(){
            $('#FormModal').modal({ keyboard: false, backdrop: 'static' })
        },
        methods:{
            async store(){
                if(this.loading) return
                this.loading = true

                await axios
                    .post('api/users', this.form)
                    .then(res => {
                        if(res.data.saved){
                            Swal.fire(this.titleModal, 'Se guardo correctamente.', 'success')
                            .then(() => this.closeModal() )
                            this.$emit('new', res.data.user)
                            return
                        }
                        Swal.fire('Ops..!', 'No se guardo el registro.', 'error')
                        console.log(res.data)
                    })
                    .catch(error => {
                        if (error.response.status === 422) {
                            Swal.fire('casi', 'Corrige algunos datos.', 'warning')
                            this.errors = error.response.data
                            return
                        }
                        else{
                            Swal.fire('Error', 'Ocurrio un error.', 'error')
                            console.log(error)
                        }
                    })
                    .finally(() => {
                        this.loading = false;
                    })
            },
            showModal(title, form = null){
                this.titleModal = title

                if(!form) this.resetData()
                if(form) this.form = form
                $('#FormModal').modal('show')

                this.load = true
            },
            closeModal(){
                $('#FormModal').modal('hide')
                this.resetData()
            },
            resetData(){
                this.errors = null
                this.form = {
                    name: null,
                    email: null,
                    password: null,
                    password_confirm:null
                }
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>
