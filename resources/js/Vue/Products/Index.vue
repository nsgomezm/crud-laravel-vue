<template>
    <div class="card">
        <div class="card-header d-flex align-items-center flex-wrap">
            <b>Productos</b>
            <div class="ml-auto">
                <button class="btn btn-outline-success" v-on:click="addProduct()">Nuevo Producto <i class="fa-solid fa-cart-shopping    "></i></button>

            </div>
        </div>
        <div class="card-body">
            <user-table :data="products" v-on:delete="removedUser"/>
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
                        this.products = res.data
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
            addProduct(){
                this.$refs.modal.showModal('Nuevo producto')
            },
            newRow(product){
                this.products.push(product)
            },
            removedUser(product){
                this.products.splice( this.products.indexOf(product), 1)
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>
