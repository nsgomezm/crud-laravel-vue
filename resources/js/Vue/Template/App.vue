<template>
    <base-header/>
    <base-sidebar/>
    <div  class="content-wrapper p-4">
        <router-view/>
    </div>
</template>

<script>

    import BaseHeader from './includes/navbar'
    import BaseSidebar from './includes/sidebar'
    export default {
        components:{
            BaseHeader,
            BaseSidebar
        },
        computed:{
            nameCurrentPage(){ return this.$store.getters.nameCurrentPage; }
        },

        watch:{
            nameCurrentPage(){ document.title = this.nameCurrentPage }
        },

        created(){
            document.title = this.nameCurrentPage
            this.$store.dispatch('user/getUsers')
        }
    }
</script>

<style lang="scss" scoped>

</style>
