<template>
    <!-- Modal -->
    <div class="modal fade" id="DetailModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="DetailModalLabel">{{ titleModal }}</h5>
                    <button type="button" class="close" v-on:click="closeModal()" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="overlay" v-if="!load">
                        <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                    </div>
                    <backend-errors :errors="errors"/>

                    <form v-on:submit.prevent="store()" v-if="form">
                        <div class="form-row">
                            <v-select class="col-12 col-lg-6" :options="listProduct"  label="name" v-model="form.id_producto" :reduce="product => product.id" v-if="listProduct"/>
                            <div class="input-group col-12 col-lg-3">
                                <span class="input-group-text">No.</span>
                                <input  type="numeric" v-model="form.amount" class=" form-control" v-on:keyup="getPrices()">
                            </div>
                            <div class="input-group col-12 col-lg-3">
                                <span class="input-group-text">C/U</span>
                                <input  type="numeric" :value="(form.id_producto) ? reduceProduct[form.id_producto].price : '-'" class="form-control" disabled>
                            </div>
                        </div>
                        <hr>
                        <h3>Costos</h3>
                        <div class="form-row" v-if="form.id_producto">
                            <div class="form-group col-12 col-lg-4">
                                <label>Todos los productos</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input  type="numeric" :value="form.sum" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="form-group col-12 col-lg-4">
                                <label>IVA ({{ $store.state.iva }}%)</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input  type="numeric" :value="form.sum_iva" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="form-group col-12 col-lg-4">
                                <label>Total</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input  type="numeric" :value="form.sum_all" class="form-control" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <label>Comentarios</label>
                            <textarea v-model="form.comments"  rows="5" class="form-control w-100"></textarea>
                        </div>
                        <input type="submit" class="d-none" id="submitDetail">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" v-on:click="closeModal()">Close</button>
                    <label for="submitDetail" :class="`btn btn-primary ${loading ? 'disabled' : ''}`" :disabled="loading">
                        {{ loading ? 'Guardando...' : 'Guardar' }}
                    </label>
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
                listProduct: null,

                form: null
            }
        },
        computed:{
            reduceProduct(){
                if(this.listProduct){
                    return this.listProduct.reduce((acc, el) => ({
                        ...acc,
                        [el.id]: el
                    }), {} )
                }
                return '-'
            },
        },
        created(){
            this.getListProduct()
        },
        methods:{
            async store(){
                if(this.loading) return

                if(!this.form.id_producto){
                    Swal.fire('Requerimiento', 'El campo producto es requerido.', 'warning')
                    return
                }

                this.loading = true
                this.form.id_bills = this.$parent.bill.id
                let url = `api/shoppings/${this.form.id_producto}/${this.form.id ?  this.form.id : ''}`

                await axios
                    .post(url, this.form)
                    .then(res => {
                        if(res.data.saved){
                            Swal.fire(this.titleModal, 'Se guardo correctamente.', 'success')
                            .then(() => {
                                this.closeModal()
                                this.$emit('new', res.data.shopping)
                            })
                            return
                        }
                        Swal.fire('Lo sentimos', res.data.message, 'warning')

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
            async getListProduct(){
                await axios
                    .get('api/products')
                    .then(res => {
                        this.listProduct = res.data.products
                    })


                    .catch(error => {
                        Swal.fire('Ops', 'No se pudieron cargar los productos', 'error')
                        console.log(error)
                    })
            },
            showModal(title, form = null){
                this.titleModal = title

                if(!form) this.resetData()
                if(form) this.form = form
                $('#DetailModal').modal('show')

                this.load = true
            },
            closeModal(){
                $('#DetailModal').modal('hide')
                this.resetData()
            },
            resetData(){
                this.errors = null
                this.form = {
                    id_producto: null,
                    amount: null,
                    comments: null,
                }
            },

            getPrices(){
                let price = this.reduceProduct[this.form.id_producto].price

                this.form.sum = this.form.amount * price
                this.form.sum_iva = this.form.sum * this.$store.state.iva
                this.form.sum_all = this.form.sum + this.form.sum_iva
            },
        }

    }
</script>

<style lang="scss" scoped>

</style>
