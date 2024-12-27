// src/services/studentsService.js
import Api from './api';

const studentsService = {
  getAll() {
    return Api.get('/students');
  },
  getById(id) {
    return Api.get(`/students/${id}`);
  },
  create(student) {
    return Api.post('/students', student);
  },
  update(id, student) {
    return Api.put(`/students/${id}`, student);
  },
  delete(id) {
    return Api.delete(`/students/${id}`);
  },
};

export default studentsService;
