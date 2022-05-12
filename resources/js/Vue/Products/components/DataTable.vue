<template>
    <div>
        <table class="table table-striped" id="table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Existentes</th>
                    <th>Precio</th>
                    <th>Descripcion</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody v-if="data">
                <tr v-for="(row, index) in data" :key="index">
                    <td>{{ row.name }}</td>
                    <td>{{ row.stock }}</td>
                    <td>{{ row.price }}</td>
                    <td>{{ row.descript }}</td>
                    <td>
                        <a href="#" v-on:click.prevent="$emit('edit', row)" class="btn btn-sm btn-primary mr-2"><i class="fa-solid fa-user-pen"></i></a>
                        <a href="#" v-on:click.prevent="destroy(row)" class="btn btn-sm btn-danger"><i class="fa-solid fa-user-minus"></i></a>
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
            destroy(product){
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
                        this.delete(product)
                    }
                })
            },

            async delete(product){
                await axios
                    .delete(`/api/products/${product.id}`)
                    .then(res => {
                        if(res.data.deleted){
                            Swal.fire('', 'Se elimino correctamente', 'success')
                            this.$emit('delete', product)

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
