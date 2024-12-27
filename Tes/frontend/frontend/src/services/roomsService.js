import api from './api';

export default {
  getAll() {
    return api.get('/rooms');
  },
  getById(id) {
    return api.get(`/rooms/${id}`);
  },
  create(data) {
    return api.post('/rooms', data);
  },
  update(id, data) {
    return api.put(`/rooms/${id}`, data);
  },
  delete(id) {
    return api.delete(`/rooms/${id}`);
  }
};
