import Home from './Vue/Admin/Home'
import User from './Vue/User/Index'
import Prodcut from './Vue/Products/Index'

export default [
    { path: '/', name: 'home', component: Home},
    { path: '/Usuarios', name: 'user', component: User},
    { path: '/Productos', name: 'product', component: Prodcut},
]
