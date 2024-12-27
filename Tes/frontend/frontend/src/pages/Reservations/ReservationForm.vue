<template>
    <div class="container mt-4" style="max-width:600px;">
      <h2>{{ isEdit ? 'Edit Reservation' : 'Add Reservation' }}</h2>
      <form @submit.prevent="handleSubmit">
        <div class="mb-3">
          <label class="form-label">Customer Name</label>
          <input type="text" class="form-control" v-model="reservation.customer_name" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Room</label>
          <select class="form-select" v-model="reservation.room_id" required>
            <option v-for="room in rooms" :key="room.id" :value="room.id">
              {{ room.room_number }} ({{ room.room_type }})
            </option>
          </select>
        </div>
        <div class="mb-3">
          <label class="form-label">Check In Date</label>
          <input type="date" class="form-control" v-model="reservation.check_in_date" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Check Out Date</label>
          <input type="date" class="form-control" v-model="reservation.check_out_date" required>
        </div>
        <button class="btn btn-primary" type="submit">Save</button>
        <router-link class="btn btn-secondary ms-2" to="/reservations">Cancel</router-link>
      </form>
    </div>
  </template>
  
  <script>
  import reservationsService from '../../services/reservationsService';
  import roomsService from '../../services/roomsService';
  
  export default {
    props: {
      id: {
        type: String,
        default: null
      }
    },
    data() {
      return {
        reservation: {
          customer_name: '',
          room_id: '',
          check_in_date: '',
          check_out_date: ''
        },
        rooms: [],
        isEdit: false
      }
    },
    async created() {
      // Ambil daftar rooms untuk dropdown
      const resRooms = await roomsService.getAll();
      this.rooms = resRooms.data;
  
      if (this.id) {
        this.isEdit = true;
        const res = await reservationsService.getById(this.id);
        this.reservation = {
          customer_name: res.data.customer_name,
          room_id: res.data.room_id,
          check_in_date: res.data.check_in_date,
          check_out_date: res.data.check_out_date
        }
      }
    },
    methods: {
      async handleSubmit() {
        if (this.isEdit) {
          await reservationsService.update(this.id, this.reservation);
        } else {
          await reservationsService.create(this.reservation);
        }
        this.$router.push('/reservations');
      }
    }
  }
  </script>
  