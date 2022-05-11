<template>
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
            <tr v-for="(item, index) in shoppings" :key="index">
                <td>{{ item.product.name  }}</td>
                <td>{{ item.amount  }}</td>
                <td>{{ item.product.price  }}</td>
                <td>{{ item.sum  }}</td>
                <td>{{ item.sum_iva  }}</td>
                <td>{{ item.sum_all  }}</td>
                <td>
                    <a href="#" v-on:click.prevent="$emit('edit', item)" class="btn btn-sm btn-primary mr-2"><i class="fa-solid fa-pen-to-square"></i></a>
                    <a href="#" v-on:click.prevent="destroy(item)" class="btn btn-sm btn-danger"><i class="fa-solid fa-cart-arrow-down"></i></a>
                </td>
            </tr>
        </tbody>
        <tr>
            <th colspan="3">Totales</th>
            <th>{{ shoppings.reduce( ( acc, item) => { return acc = acc + item.sum }, 0 ) }}</th>
            <th>{{ shoppings.reduce( ( acc, item) => { return acc = acc + item.sum_iva }, 0 ) }}</th>
            <th>{{ shoppings.reduce( ( acc, item) => { return acc = acc + item.sum_all }, 0 ) }}</th>
        </tr>
    </table>
</template>

<script>
    export default {
        props:['shoppings'],
        methods:{
            destroy(item){
                Swal.fire({
                    title: 'Estas seguro?',
                    text: "No se podra revertir esta acción!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
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
                    .delete(`/api/shoppings/${item.product.id}/${item.id}`)
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
