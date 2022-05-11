<template>
    <div>
        <table class="table table-striped" id="table">
            <thead>
                <tr>
                    <th>ID factura</th>
                    <th>Cedula</th>
                    <th>Nombre</th>
                    <th>No. Compras</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody v-if="data">
                <tr v-for="(row, index) in data" :key="index">
                    <td>{{ row.id }}</td>
                    <td>{{ row.user.cedula }}</td>
                    <td>{{ row.user.name }}</td>
                    <td>{{ row.shoppings.length }}</td>
                    <td>
                        <router-link :to="{name:'bills.details', params:{ id: row.id} }" class="btn btn-sm btn-primary mr-2">
                            <i class="fa-solid fa-up-right-from-square"></i>
                        </router-link>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        props:['data'],
    }
</script>

<style lang="scss" scoped>

</style>
