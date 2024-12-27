<template>
    <div class="container mt-4">
      <h1>Reservations</h1>
      <div class="text-end mb-3">
        <router-link class="btn btn-primary" :to="{ name: 'ReservationCreate' }">Add Reservation</router-link>
      </div>
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>Customer Name</th>
            <th>Room</th>
            <th>Check In</th>
            <th>Check Out</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="res in reservations" :key="res.id">
            <td>{{ res.customer_name }}</td>
            <td>{{ res.room ? res.room.room_number : 'N/A' }}</td>
            <td>{{ res.check_in_date }}</td>
            <td>{{ res.check_out_date }}</td>
            <td>
              <router-link :to="{ name: 'ReservationEdit', params: { id: res.id } }" class="btn btn-sm btn-warning me-2">Edit</router-link>
              <button class="btn btn-sm btn-danger" @click="deleteReservation(res.id)">Delete</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </template>
  
  <script>
  import reservationsService from '../../services/reservationsService';
  
  export default {
    data() {
      return {
        reservations: []
      }
    },
    async created() {
      const response = await reservationsService.getAll();
      this.reservations = response.data;
    },
    methods: {
      async deleteReservation(id) {
        if (confirm('Are you sure want to delete this reservation?')) {
          await reservationsService.delete(id);
          this.reservations = this.reservations.filter(r => r.id !== id);
        }
      }
    }
  }
  </script>
  