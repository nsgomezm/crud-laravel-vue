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
        <!--
            buscador de factura/usuario

        <form class="form-inline ml-3">
            <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </form> -->

    <ul class="navbar-nav ml-auto">
        <div class="dropdown no-arrow">
            <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa-solid fa-circle-user fa-xl"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                <li><a class="dropdown-item" href="#">Editar perfil</a></li>
                <li><a class="dropdown-item" href="/logout">Cerrar Sesión</a></li>
            </ul>
        </div>
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
