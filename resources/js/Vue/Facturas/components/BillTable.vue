<template>
    <div>
        <table class="table table-striped" id="table">
            <thead>
                <tr>
                    <th>ID factura</th>
                    <th>Cedula</th>
                    <th>Nombre</th>
                    <th>No. Productos   </th>
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
                        <router-link :to="{name:'bills.details', params:{ id: row.id} }" class="btn btn-sm btn-secondary mr-2">
                            <i class="fa-solid fa-up-right-from-square"></i>
                        </router-link>
                        <a href="#" v-on:click.prevent="$emit('edit', row)" class="btn btn-sm  btn-primary mr-2"><i class="fa-solid fa-magnifying-glass-plus"></i></a>
                        <a href="#" v-on:click.prevent="destroy(row)" class="btn btn-sm  btn-danger mr-2"><i class="fa-solid fa-trash"></i></a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        props:['data'],

        methods:{
            destroy(item){
                Swal.fire({
                    title: 'Estas seguro?',
                    text: "No se podra revertir esta acción!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    CancelButtonText: 'Cancelar',
                    confirmButtonText: 'Si, eliminar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.delete(item)
                    }
                })
            },

            async delete(item){
                await axios
                    .delete(`/api/bills/${item.id}`)
                    .then(res => {
                        if(res.data.deleted){
                            Swal.fire('', 'Se elimino correctamente', 'success')
                            this.$emit('delete', item)
                            return
                        }
                        Swal.fire('Ops...!', 'No se pudo eliminar', 'error')
                    })
                    .catch(error => {
                        Swal.fire('Ops...!', 'Ocurrio un error', 'error')
                        console.log(error)
                    })
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>
