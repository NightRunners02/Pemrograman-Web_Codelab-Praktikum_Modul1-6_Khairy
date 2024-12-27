import axios from 'axios';

const api = axios.create({
  baseURL: 'http://localhost:8000/api', // ganti sesuai URL backend Laravel Anda
});

// Optional: Anda bisa menambahkan interceptors untuk error handling global disini

export default api;
