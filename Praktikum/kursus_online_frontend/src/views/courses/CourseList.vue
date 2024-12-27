<template>
  <div class="container mt-4">
    <h1>Daftar Kursus</h1>
    <div class="text-end mb-3">
      <router-link class="btn btn-primary" :to="{ name: 'CourseCreate' }">Tambah Kursus</router-link>
    </div>
    <table class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nama Kursus</th>
          <th>Deskripsi</th>
          <th>Harga</th>
          <th>Dibuat Pada</th>
          <th>Diperbarui Pada</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="course in courses" :key="course.id">
          <td>{{ course.id }}</td>
          <td>{{ course.course_name }}</td>
          <td>{{ course.description }}</td>
          <td>{{ course.price }}</td>
          <td>{{ course.created_at }}</td>
          <td>{{ course.updated_at }}</td>
          <td>
            <router-link
              :to="{ name: 'CourseEdit', params: { id: course.id } }"
              class="btn btn-sm btn-warning me-2"
            >
              Edit
            </router-link>
            <button class="btn btn-sm btn-danger" @click="deleteCourse(course.id)">Hapus</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import coursesService from '../../services/coursesService';

export default {
  data() {
    return {
      courses: [],
    };
  },
  async created() {
    const response = await coursesService.getAll();
    this.courses = response.data;
  },
  methods: {
    async deleteCourse(id) {
      if (confirm('Apakah Anda yakin ingin menghapus kursus ini?')) {
        await coursesService.delete(id);
        this.courses = this.courses.filter(course => course.id !== id);
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
