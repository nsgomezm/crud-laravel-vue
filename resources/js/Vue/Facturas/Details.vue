<template>
    <div>
        <!-- <h1>{{ $route.params.id}}</h1> -->
        <backend-errors :errors="errors"/>
        <form v-on:submit.prevent="store()" v-if="load">
            <div class="form-row">
                <div class="col-12 col-lg-8 mb-3">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">CC</span>
                        <input type="text" class="form-control" disabled :value="bill.user.cedula">
                        <input type="text" class="form-control" disabled :value="bill.user.name">
                    </div>
                </div>
                <div class="col-12 col-lg-4 mb-3 text-center text-lg-end">
                    <a href="#" class="btn btn-outline-success">Add product  <i class="fa-solid fa-plus"></i></a>
                </div>
            </div>
                <table class="table" id="table">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Valor C/U</th>
                            <th>Valor sin IVA</th>
                            <th>IVA</th>
                            <th>Total</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in bill.shoppings" :key="index">
                            <td>{{ item.product.name  }}</td>
                            <td>{{ item.amount  }}</td>
                            <td>{{ item.product.price  }}</td>
                            <td>{{ item.sum  }}</td>
                            <td>{{ item.sum_iva  }}</td>
                            <td>{{ item.sum_all  }}</td>
                            <td>
                                <a href="#" v-on:click.prevent="$emit('edit', row)" class="btn btn-sm btn-primary mr-2"><i class="fa-solid fa-user-pen"></i></a>
                                <a href="#" v-on:click.prevent="destroy(row)" class="btn btn-sm btn-danger"><i class="fa-solid fa-user-minus"></i></a>
                            </td>
                        </tr>
                    </tbody>
                    <tr>
                        <th colspan="3">Totales</th>
                        <th>{{ bill.sum}}</th>
                        <th>{{ bill.sum_iva }}</th>
                        <th>{{ bill.sum_all }}</th>
                    </tr>
                </table>

            <input type="submit" class="d-none" id="submit">
        </form>

    </div>
</template>

<script>
    export default {
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
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>
