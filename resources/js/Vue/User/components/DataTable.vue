<template>
    <div>
        <table class="table table-striped" id="table">
            <thead>
                <tr>
                    <th>Cedula</th>
                    <th>Nombre</th>
                    <th>Correo electronico</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody v-if="data">
                <tr v-for="(row, index) in data" :key="index">
                    <td>{{ row.cedula }}</td>
                    <td>{{ row.name }}</td>
                    <td>{{ row.email }}</td>
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
            destroy(user){
                Swal.fire({
                    text: `Seguro que deseas eliminar el registro de (${user.name})?`,
                    icon:'question',
                    showDenyButton: true,
                    confirmButtonText: 'Cancelar',
                    denyButtonText: `Eliminar`,

                }).then((result) => {
                    if (!result.isConfirmed) {
                        this.delete(user)
                    }
                })
            },

            async delete(user){
                await axios
                    .delete(`/api/users/${user.id}`)
                    .then(res => {
                        if(res.data.deleted){
                            Swal.fire('', 'Se elimino correctamente', 'success')
                            this.$emit('delete', user)

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
