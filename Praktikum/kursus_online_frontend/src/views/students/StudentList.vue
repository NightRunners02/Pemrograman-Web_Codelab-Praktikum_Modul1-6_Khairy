<template>
  <div class="container mt-4">
    <h1>Daftar Mahasiswa</h1>
    <div class="text-end mb-3">
      <router-link class="btn btn-primary" :to="{ name: 'StudentCreate' }">Tambah Mahasiswa</router-link>
    </div>
    <table class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Nama</th>
          <th>Email</th>
          <th>Kursus</th>
          <th style="width: 200px;">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="student in students" :key="student.id">
          <td>{{ student.name }}</td>
          <td>{{ student.email }}</td>
          <td>{{ student.course ? student.course.course_name : 'N/A' }}</td>
          <td>
            <router-link :to="{ name: 'StudentEdit', params: { id: student.id } }" class="btn btn-sm btn-warning me-2">
              Edit
            </router-link>
            <button class="btn btn-sm btn-danger" @click="deleteStudent(student.id)">Hapus</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import studentsService from '../../services/studentsService';

export default {
  data() {
    return {
      students: [],
    };
  },
  async created() {
    // Mengambil daftar mahasiswa dari API
    const response = await studentsService.getAll();
    this.students = response.data;
  },
  methods: {
    async deleteStudent(id) {
      if (confirm('Apakah Anda yakin ingin menghapus mahasiswa ini?')) {
        await studentsService.delete(id);
        this.students = this.students.filter(student => student.id !== id);
      }
    },
  },
};
</script>

<style scoped>
.container {
  max-width: 800px;
  margin: auto;
}
</style>
