<template>
  <div class="container mt-4" style="max-width:600px;">
    <h2>{{ isEdit ? 'Edit Student' : 'Add Student' }}</h2>
    <form @submit.prevent="handleSubmit">
      <!-- Nama Mahasiswa -->
      <div class="mb-3">
        <label class="form-label">Nama</label>
        <input type="text" class="form-control" v-model="student.name" required />
      </div>

      <!-- Email Mahasiswa -->
      <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" class="form-control" v-model="student.email" required />
      </div>

      <!-- Kursus -->
      <div class="mb-3">
        <label class="form-label">Kursus</label>
        <select class="form-select" v-model="student.course_id" required>
          <option v-for="course in courses" :key="course.id" :value="course.id">
            {{ course.course_name }}
          </option>
        </select>
      </div>

      <!-- Tombol Aksi -->
      <button class="btn btn-primary" type="submit">Save</button>
      <router-link class="btn btn-secondary ms-2" to="/students">Cancel</router-link>
    </form>
  </div>
</template>

<script>
import studentsService from '../../services/studentsService';
import coursesService from '../../services/coursesService';

export default {
  props: {
    id: {
      type: String,
      default: null,
    },
  },
  data() {
    return {
      student: {
        name: '',
        email: '',
        course_id: '',
      },
      courses: [],
      isEdit: false,
    };
  },
  async created() {
    // Ambil daftar kursus untuk dropdown
    const responseCourses = await coursesService.getAll();
    this.courses = responseCourses.data;

    // Jika id ada, ambil data mahasiswa untuk edit
    if (this.id) {
      this.isEdit = true;
      const responseStudent = await studentsService.getById(this.id);
      this.student = responseStudent.data;
    }
  },
  methods: {
    async handleSubmit() {
      if (this.isEdit) {
        await studentsService.update(this.id, this.student);
      } else {
        await studentsService.create(this.student);
      }
      this.$router.push('/students');
    },
  },
};
</script>

<style scoped>
.container {
  max-width: 600px;
  margin: auto;
}
</style>
