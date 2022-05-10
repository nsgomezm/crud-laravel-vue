<template>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="/" class="brand-link">
            <span class="brand-text font-weight-light"> {{ $store.state.appName }}</span>
        </a>

        <div class="sidebar">
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                    <router-link custom :to="item.linkTo" v-slot="{href, isActive, navigate }" v-for="(item, index) in menu" :key="index">
                        <li :class="`nav-item`"> <!--  ${ isActive ? 'menu-open': '' } -->
                            <a :href="href" :class="`nav-link ${ isActive ? 'active': '' }`" v-on:click="navigate, $store.dispatch('setNameActivePage', item.name)">
                                <i :class="`nav-icon mr-3 ${item.icon}`"></i>
                                <p>
                                    {{ item.name }}
                                    <i :class="`right fas fa-angle-left`" v-show="item.hasOwnProperty('children')"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview" v-if="item.hasOwnProperty('children')">
                                <router-link custom :to="item.linkTo" v-slot="{href, isActive, navigate }" v-for="(subitem, index) in item.children" :key="index">
                                    <li class="nav-item">
                                        <a :href="href" :class="`nav-link ${ isActive ? 'active': '' }`" v-on:click="navigate, $store.dispatch('setNameActivePage', subitem.name )">
                                            {{ subitem.name }}
                                        </a>
                                    </li>
                                </router-link>
                            </ul>
                        </li>
                    </router-link>
                </ul>
            </nav>
        </div>
    </aside>
</template>

<script>
    export default {
        data(){
            return {
                menu: [
                    {
                        name: 'Home',
                        linkTo: { name: 'home'},
                        icon: 'fa-solid fa-house',
                        // children: [
                        //     {
                        //         name: 'Home',
                        //         linkTo: { name: 'home'},
                        //         icon: 'fa-solid fa-house'
                        //     },
                        // ]
                    },
                    {
                        name: 'Users',
                        linkTo: { name: 'user'},
                        icon: 'fa-solid fa-users',
                    },
                    {
                        name: 'Prodcutos',
                        linkTo: { name: 'product'},
                        icon: 'fa-solid fa-folder',
                    },
                ]
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>

