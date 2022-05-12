<template>
    <div class="card">
        <div class="card-header d-flex align-items-center flex-wrap">
            <b>Productos</b>
            <div class="ml-auto">
                <button class="btn btn-outline-success" v-on:click="showForm()">Nuevo Producto <i class="fa-solid fa-cart-shopping    "></i></button>
            </div>
        </div>
        <div class="card-body">
            <data-table :data="products" v-on:edit="showForm" v-on:delete="removeProduct"/>
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
        data(){
            return{
                products: null
            }
        },
        created(){
            this.getData()
        },
        methods:{
            async getData(){
                await axios
                    .get('/api/products')
                    .then(res => {
                        this.products = res.data.products
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
            showForm(product = null){
                this.$refs.modal.showModal(`${product ? 'Actualizar' : 'Nuevo '} producto`, product)
            },
            newRow(product){
                let existsProduct = this.products.indexOf(product)
                if(existsProduct >= 0){
                    this.products[existsProduct] = product
                    return
                }
                this.products.push(product)
            },
            removeProduct(product){
                this.products.splice( this.products.indexOf(product), 1)
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>
