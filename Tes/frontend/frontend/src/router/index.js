import { createRouter, createWebHistory } from 'vue-router'
import RoomsList from '../pages/Rooms/RoomsList.vue'
import RoomForm from '../pages/Rooms/RoomForm.vue'
import ReservationsList from '../pages/Reservations/ReservationsList.vue'
import ReservationForm from '../pages/Reservations/ReservationForm.vue'

const routes = [
  { path: '/', redirect: '/rooms' },
  { path: '/rooms', name: 'RoomsList', component: RoomsList },
  { path: '/rooms/create', name: 'RoomCreate', component: RoomForm },
  { path: '/rooms/edit/:id', name: 'RoomEdit', component: RoomForm, props: true },
  { path: '/reservations', name: 'ReservationsList', component: ReservationsList },
  { path: '/reservations/create', name: 'ReservationCreate', component: ReservationForm },
  { path: '/reservations/edit/:id', name: 'ReservationEdit', component: ReservationForm, props: true }
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router
