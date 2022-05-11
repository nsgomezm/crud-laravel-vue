<template>
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" disabled> {{ $store.state.nameActivePage }}  </a> <!-- {{ $store.getters.nameCurrentPage }} -->
        </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        <a class="dropdown-item" href="/logout">Cerrar Sesión</a>
    </ul>
</nav>
<!-- /.navbar -->
</template>

<script>
    export default {

    }
</script>

<style lang="scss" scoped>

</style>
