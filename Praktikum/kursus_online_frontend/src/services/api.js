// src/services/api.js
import axios from 'axios';

const Api = axios.create({
  baseURL: 'http://127.0.0.1:8000/api/', // Ganti dengan base URL backend Anda
});

export default Api;
