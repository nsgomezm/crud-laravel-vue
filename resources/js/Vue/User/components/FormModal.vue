<template>
    <!-- Modal -->
    <div class="modal fade" id="FormModal" tabindex="-1" aria-labelledby="FormModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="FormModalLabel">{{ titleModal }}</h5>
                    <button type="button" class="close" v-on:click="closeModal()" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" v-on:click="closeModal()">Close</button>
                    <button type="button" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                titleModal: null
            }
        },
        methods:{
            showModal(title){
                this.titleModal = title
                $('#FormModal').modal('show')
            },
            closeModal(){
                $('#FormModal').modal('hide')
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>
