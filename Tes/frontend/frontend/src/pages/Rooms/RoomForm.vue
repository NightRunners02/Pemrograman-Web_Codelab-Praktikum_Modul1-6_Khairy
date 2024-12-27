<template>
    <div class="container mt-4" style="max-width:600px;">
      <h2>{{ isEdit ? 'Edit Room' : 'Add Room' }}</h2>
      <form @submit.prevent="handleSubmit">
        <div class="mb-3">
          <label class="form-label">Room Number</label>
          <input type="text" class="form-control" v-model="room.room_number" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Room Type</label>
          <input type="text" class="form-control" v-model="room.room_type" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Price</label>
          <input type="number" class="form-control" v-model="room.price" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Status</label>
          <select class="form-select" v-model="room.status">
            <option value="available">Available</option>
            <option value="unavailable">Unavailable</option>
          </select>
        </div>
        <button class="btn btn-primary" type="submit">Save</button>
        <router-link class="btn btn-secondary ms-2" to="/rooms">Cancel</router-link>
      </form>
    </div>
  </template>
  
  <script>
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
        room: {
          room_number: '',
          room_type: '',
          price: '',
          status: 'available'
        },
        isEdit: false
      }
    },
    async created() {
      if (this.id) {
        this.isEdit = true;
        const response = await roomsService.getById(this.id);
        this.room = response.data;
      }
    },
    methods: {
      async handleSubmit() {
        if (this.isEdit) {
          await roomsService.update(this.id, this.room);
        } else {
          await roomsService.create(this.room);
        }
        this.$router.push('/rooms');
      }
    }
  }
  </script>
  