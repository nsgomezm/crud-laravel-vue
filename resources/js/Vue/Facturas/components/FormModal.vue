<template>
    <!-- Modal -->
    <div class="modal fade" id="FormModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-lg">
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
                        <div class="form-row mb-3">
                            <div class="input-group col-12 col-lg-6">
                                <span class="input-group-text">CC</span>
                                <input type="numeric" placeholder="cedula" class="form-control" v-model="user.id" :disabled="form.id">
                                <button class="btn btn-outline-secondary" v-on:click.prevent="getUser()" v-if="!form.id"><i class="fa-solid fa-magnifying-glass"></i></button>

                            </div>
                            <input type="text" class="form-control col-12 col-lg-6" :value="user.name" disabled>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-12">
                                <label>Comentaios</label>
                                <textarea rows="5" class="form-control" v-model="form.comments" :disabled="form.id"></textarea>
                            </div>
                        </div>
                        <input type="submit" class="d-none" id="submit">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" v-on:click="closeModal()">Close</button>
                    <label for="submit" :class="`btn btn-primary ${loading ? 'disabled' : ''}`" :disabled="loading" v-if="!form.id">{{ loading ? 'Guardando...' : 'Guardar' }}</label>
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

                user: {
                    id: null,
                    name: null
                },
                form: {
                    id_user: null,
                    comments: null,
                }
            }
        },
        methods:{
            async store(){
                if(this.form.id) return


                if(this.loading) return
                this.loading = true
                await axios
                    .post('api/bills/', this.form)
                    .then(res => {
                        if(res.data.saved){
                            Swal.fire(this.titleModal, 'Se guardo correctamente.', 'success')
                            .then(() => this.closeModal() )
                            this.$emit('new', res.data.bill)
                            return
                        }
                        Swal.fire('Ops..!', 'No se guardo el registro.', 'error')
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
            async getUser(){
                await axios
                    .get(`api/users/validCedula/${this.user.id}`)
                    .then(res => {
                        if(res.data.users){
                            let user = res.data.users
                            this.user.name = user.name
                            this.form.id_user = user.id
                            return
                        }

                        Swal.fire({
                            title: 'Ops..!"',
                            text: 'Cedula no registada',
                            icon: 'warning',
                            showDenyButton: true,
                            showCancelButton: true,
                            cancelButtonText: 'Cancelar',
                            confirmButtonText: 'Registrar otra cedula',
                            denyButtonText: `Ingresar otra cedula`,
                        }).then((result) => {
                            /* Read more about isConfirmed, isDenied below */
                            if (result.isConfirmed) {
                                this.closeModal()
                                this.$router.push({ name: 'user'})
                            } else if (result.isDenied) {
                                this.user.id = ''
                            }
                        })
                    })
            },
            showModal(title, form = null){
                this.titleModal = title

                if(!form) this.resetData()
                if(form) {
                    this.form = form
                    this.user = {
                        id: form.user.cedula,
                        name: form.user.name
                    }
                }

                $('#FormModal').modal('show')

                this.load = true
            },
            closeModal(){
                $('#FormModal').modal('hide')
                this.resetData()
            },
            resetData(){
                this.errors = null
                this.user = {
                    id: null,
                    name: null,
                }
                this.form = {
                    id_user: null,
                    comments: null,

                }
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>
