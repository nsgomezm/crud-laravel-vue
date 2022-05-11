<template>
    <div>
        <backend-errors :errors="errors"/>
        <div v-if="load">
            <div class="form-row">
                <div class="col-12 col-lg-8 mb-3">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">CC</span>
                        <input type="text" class="form-control" disabled :value="bill.user.cedula">
                        <input type="text" class="form-control" disabled :value="bill.user.name">
                    </div>
                </div>
                <div class="col-12 col-lg-4 mb-3 text-center text-lg-end">
                    <a href="#" class="btn btn-outline-success" v-on:click.prevent="showForm()">Add product  <i class="fa-solid fa-plus"></i></a>
                </div>
            </div>

            <detail-table :shoppings="bill.shoppings" v-on:edit="showForm" v-on:delete="removedRow" />

            <input type="submit" class="d-none" id="submit">
        </div>
        <detail-modal ref="modal" v-on:new="newRow" />
    </div>
</template>

<script>
    import DetailTable from './components/DetailTable'
    import DetailModal from './components/DetailModal'
    export default {
        components:{
            DetailTable,
            DetailModal
        },
        data(){
            return {
                load: false,
                bill: null,
                errors: null,
            }
        },
        created(){
            this.getData()
        },

        methods:{
            async getData(){
                await axios
                    .get(`/api/bills/${this.$route.params.id}`)
                    .then(res => {
                        this.bill = res.data.bills
                    })
                    .finally(() => {
                        $(document).ready( function () {
                            $('#table').DataTable();
                        });
                        this.load = true
                    })
            },
            showForm(product = null){
                this.$refs.modal.showModal(`${product ? 'Actualizar' : 'Nuevo '} compra`, product)
            },
            newRow(shopping ){
                let existsShopping = this.bill.shoppings.indexOf(shopping)
                if(existsShopping >= 0){
                    this.bill.shoppings[existsShopping] = shopping
                    console.log(this.bill.shoppings[existsShopping])
                    return
                }

                console.log(this.bill.shoppings, shopping)
                this.bill.shoppings.push(shopping)
            },
            removedRow(shopping){
                this.bill.shoppings.splice( this.bill.shoppings.indexOf(shopping), 1)
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>
