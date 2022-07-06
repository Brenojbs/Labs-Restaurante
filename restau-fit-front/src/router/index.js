import Vue from 'vue'
import Reserva from '../views/Reserva'
import Login from '../views/Login'
import Admin from '../views/Admin'
import Cliente from '../views/Cliente'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'Login',
    component: Login
  },
  {
    path: '/reserva',
    name: 'Reserva',
    component: Reserva
  },
  {
    path: '/cliente',
    name: 'Cliente',
    component: Cliente
  },
  {
    path: '/admin',
    name: 'Administrador',
    component: Admin
  }
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
