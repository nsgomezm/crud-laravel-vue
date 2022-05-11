import Home from './Vue/Admin/Home'
import User from './Vue/User/Index'
import Prodcut from './Vue/Products/Index'
import Bills from './Vue/Facturas/Index'
import BillsDetails from './Vue/Facturas/Details'

export default [
    { path: '/', name: 'home', component: Home},
    { path: '/Usuarios', name: 'user', component: User},
    { path: '/Productos', name: 'product', component: Prodcut},
    { path: '/Facturas', name: 'bills', component: Bills},
    { path: '/Facturas/:id', name: 'bills.details', component: BillsDetails},
]
