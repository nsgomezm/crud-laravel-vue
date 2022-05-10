export default[
    { path: '/', name: 'home', component:  () => import('@/Vue/Admin/Home') },
    { path: '/User', name: 'user', component:  () => import('@/Vue/User/index') },
]
