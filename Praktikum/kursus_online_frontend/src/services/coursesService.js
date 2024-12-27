// src/services/coursesService.js
import Api from './api';

const coursesService = {
  getAll() {
    return Api.get('/courses');
  },
  getById(id) {
    return Api.get(`/courses/${id}`);
  },
  create(course) {
    return Api.post('/courses', course);
  },
  update(id, course) {
    return Api.put(`/courses/${id}`, course);
  },
  delete(id) {
    return Api.delete(`/courses/${id}`);
  },
};

export default coursesService;
