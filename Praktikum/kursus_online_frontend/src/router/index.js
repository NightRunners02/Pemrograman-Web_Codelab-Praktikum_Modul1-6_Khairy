import { createRouter, createWebHistory } from 'vue-router';

// Import komponen
import StudentList from '../views/students/StudentList.vue';
import FormStudent from '../views/students/FormStudent.vue';
import CourseList from '../views/courses/CourseList.vue';
import FormCourses from '../views/courses/FormCourses.vue';

const routes = [
  {
    path: '/students',
    name: 'StudentList',
    component: StudentList,
  },
  {
    path: '/students/create',
    name: 'StudentCreate',
    component: FormStudent,
  },
  {
    path: '/students/edit/:id',
    name: 'StudentEdit',
    component: FormStudent,
    props: true, // Kirim ID sebagai props
  },
  {
    path: '/courses',
    name: 'CourseList',
    component: CourseList,
  },
  {
    path: '/courses/create',
    name: 'CourseCreate',
    component: FormCourses,
  },
  {
    path: '/courses/edit/:id',
    name: 'CourseEdit',
    component: FormCourses,
    props: true, // Kirim ID sebagai props
  },
  {
    path: '/',
    redirect: '/students', // Redirect ke daftar mahasiswa
  },
  {
    path: '/',
    redirect: '/courses', // Redirect ke daftar mahasiswa
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
