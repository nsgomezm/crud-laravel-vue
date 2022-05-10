<template>
    <div class="alert alert-danger" role="alert" v-if="errors">
        <ul class="list-group list-group-flush">
            <li v-for="(error, index) in errors.errors" :key="index" class="list-group-item  bg-transparent">
                {{error[0]}}
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        props:['errors'],
    }
</script>

<style lang="scss" scoped>

</style>
