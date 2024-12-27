<template>
    <div class="container mt-4">
      <h1>Rooms</h1>
      <div class="text-end mb-3">
        <router-link class="btn btn-primary" :to="{ name: 'RoomCreate' }">Add New Room</router-link>
      </div>
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>Room Number</th>
            <th>Type</th>
            <th>Price</th>
            <th>Status</th>
            <th style="width: 200px;">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="room in rooms" :key="room.id">
            <td>{{ room.room_number }}</td>
            <td>{{ room.room_type }}</td>
            <td>{{ room.price }}</td>
            <td>
              <span class="badge" :class="room.status === 'available' ? 'bg-success' : 'bg-danger'">
                {{ room.status }}
              </span>
            </td>
            <td>
              <router-link :to="{ name: 'RoomEdit', params: { id: room.id } }" class="btn btn-sm btn-warning me-2">Edit</router-link>
              <button class="btn btn-sm btn-danger" @click="deleteRoom(room.id)">Delete</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </template>
  
  <script>
  import roomsService from '../../services/roomsService';
  
  export default {
    data() {
      return {
        rooms: [],
      };
    },
    async created() {
      const response = await roomsService.getAll();
      this.rooms = response.data;
    },
    methods: {
      async deleteRoom(id) {
        if (confirm('Are you sure want to delete this room?')) {
          await roomsService.delete(id);
          this.rooms = this.rooms.filter(r => r.id !== id);
        }
      }
    }
  }
  </script>
  