function scrollToSection(sectionId) {
  document.getElementById(sectionId).scrollIntoView({ behavior: "smooth" });
}

function registerCourse(courseName) {
  alert(`Anda berhasil mendaftar untuk kursus: ${courseName}`);
}

function toggleMenu() {
  const menu = document.querySelector('.nav-menu');
  menu.classList.toggle('active');
}

document.getElementById('contactForm').addEventListener('submit', function (e) {
  e.preventDefault();
  const name = document.getElementById('name').value;
  const email = document.getElementById('email').value;
  const message = document.getElementById('message').value;

  if (name && email && message) {
      alert(`Terima kasih, ${name}. Pesan Anda telah terkirim.`);
      document.getElementById('contactForm').reset();
  } else {
      alert('Mohon isi semua bidang!');
  }
});
