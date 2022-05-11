<template>
    <div class="card">
        <div class="card-header d-flex align-items-center flex-wrap">
            <b>Ventas - Facturas</b>
            <div class="ml-auto">
                <button class="btn btn-outline-success" v-on:click="showForm()">Nuevo Factura <i class="fa-solid fa-file-circle-plus"></i></button>
            </div>
        </div>
        <div class="card-body">
            <bill-table :data="facturas" v-on:edit="showForm" v-on:delete="removeFactura"/>
        </div>

        <form-modal ref="modal" v-on:new="newRow"/>
    </div>
</template>

<script>
    import BillTable from './components/BillTable'
    import FormModal from './components/FormModal'
    export default {
        components:{
            BillTable,
            FormModal
        },
        data(){
            return{
                facturas: null
            }
        },
        created(){
            this.getData()
        },
        methods:{
            async getData(){
                await axios
                    .get('/api/bills')
                    .then(res => {
                        this.facturas = res.data.bills
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
            showForm(factura = null){
                this.$refs.modal.showModal(`${factura ? 'Actualizar' : 'Nueva '} Factura`, factura)
            },
            newRow(factura){
                let existsFactura = this.facturas.indexOf(factura)
                if(existsFactura >= 0){
                    this.facturas[existsFactura] = factura
                    return
                }
                // console.log(factura)
                // console.log(this.facturas)
                this.facturas.push(factura)
            },
            removeFactura(factura){
                this.facturas.splice( this.facturas.indexOf(factura), 1)
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>
