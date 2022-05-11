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
                        <div class="form-row">
                            <!-- <div class="col-12 col-lg-4 form-floating mb-3">
                                <input autocomplete="false" type="text" class="form-control" id="name" placeholder="Producto XYZ" v-model="form.user.cedula">
                                <label for="name">Cedula</label>
                            </div>
                            <div class="col-12 col-lg-8 form-floating mb-3">
                                <input autocomplete="false" type="text" class="form-control" id="name" placeholder="125" v-model="form.user.name">
                                <label for="name">Nombre</label>
                            </div> -->
                        </div>
                            <table class="table" id="tableModal">
                            </table>

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
                    user:{
                        cedula: null,
                        name: null,
                    },
                    shoppings:{
                    }
                }
            }
        },
        methods:{
            async store(){
                if(this.loading) return
                this.loading = true
                let url = `api/products/${this.form.id ?  this.form.id : ''}`

                await axios
                    .post(url, this.form)
                    .then(res => {
                        if(res.data.saved){
                            Swal.fire(this.titleModal, 'Se guardo correctamente.', 'success')
                            .then(() => this.closeModal() )
                            this.$emit('new', res.data.product)
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
                    user:{
                        cedula: null,
                        name: null,
                    },
                    shoppings:{
                    }
                }
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>
