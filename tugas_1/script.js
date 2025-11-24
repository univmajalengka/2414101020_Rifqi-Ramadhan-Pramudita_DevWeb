// Dapatkan tombolnya
let mybutton = document.getElementById("backToTopBtn");

// Ketika pengguna menggulir ke bawah 20px dari atas dokumen, tampilkan tombol
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 300 || document.documentElement.scrollTop > 300) {
    // Tampilkan tombol jika digulir lebih dari 300px
    mybutton.style.display = "block";
  } else {
    // Sembunyikan tombol jika berada di dekat atas
    mybutton.style.display = "none";
  }
}

// Ketika pengguna mengklik tombol, gulir ke atas dokumen
function topFunction() {
  // Metode untuk smooth scrolling (berjalan baik di browser modern)
  window.scrollTo({
    top: 0,
    behavior: "smooth"
  });
}

// Anda bisa menambahkan fungsi JS lain di bawah ini, seperti pop-up atau validasi form.