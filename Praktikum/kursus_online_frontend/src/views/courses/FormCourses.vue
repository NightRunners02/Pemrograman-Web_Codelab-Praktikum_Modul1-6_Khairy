<template>
  <div class="container mt-4" style="max-width:600px;">
    <h2>{{ isEdit ? 'Edit Kursus' : 'Tambah Kursus' }}</h2>
    <form @submit.prevent="handleSubmit">
      <!-- Nama Kursus -->
      <div class="mb-3">
        <label class="form-label">Nama Kursus</label>
        <input type="text" class="form-control" v-model="course.course_name" required />
      </div>
      
      <!-- Deskripsi -->
      <div class="mb-3">
        <label class="form-label">Deskripsi</label>
        <textarea class="form-control" v-model="course.description" rows="3" required></textarea>
      </div>
      
      <!-- Harga -->
      <div class="mb-3">
        <label class="form-label">Harga</label>
        <input type="number" class="form-control" v-model="course.price" required />
      </div>

      <!-- Tanggal Mulai -->
      <div class="mb-3">
        <label class="form-label">Tanggal Mulai</label>
        <input type="date" class="form-control" v-model="course.start_date" required />
      </div>
      
      <!-- Tanggal Selesai -->
      <div class="mb-3">
        <label class="form-label">Tanggal Selesai</label>
        <input type="date" class="form-control" v-model="course.end_date" required />
      </div>

      <!-- Tombol Aksi -->
      <button class="btn btn-primary" type="submit">Simpan</button>
      <router-link class="btn btn-secondary ms-2" to="/courses">Batal</router-link>
    </form>
  </div>
</template>

<script>
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
      course: {
        course_name: '',
        description: '',
        price: 0,
        start_date: '',
        end_date: '',
      },
      isEdit: false,
    };
  },
  async created() {
    // Jika id ada, artinya edit mode
    if (this.id) {
      this.isEdit = true;
      const res = await coursesService.getById(this.id);
      this.course = {
        course_name: res.data.course_name,
        description: res.data.description,
        price: res.data.price,
        start_date: res.data.start_date,
        end_date: res.data.end_date,
      };
    }
  },
  methods: {
    async handleSubmit() {
      if (this.isEdit) {
        await coursesService.update(this.id, this.course);
      } else {
        await coursesService.create(this.course);
      }
      this.$router.push('/courses');
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
