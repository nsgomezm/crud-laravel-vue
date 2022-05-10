<template>
    <base-header/>
    <base-sidebar/>
    <router-view class="content-wrapper"/>
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
        }
    }
</script>

<style lang="scss" scoped>

</style>
