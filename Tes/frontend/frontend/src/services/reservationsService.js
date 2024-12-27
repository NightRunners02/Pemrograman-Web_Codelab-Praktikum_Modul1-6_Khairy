import api from './api';

export default {
  getAll() {
    return api.get('/reservations');
  },
  getById(id) {
    return api.get(`/reservations/${id}`);
  },
  create(data) {
    return api.post('/reservations', data);
  },
  update(id, data) {
    return api.put(`/reservations/${id}`, data);
  },
  delete(id) {
    return api.delete(`/reservations/${id}`);
  }
};
