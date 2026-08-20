// ==========================================================
// js/script.js — พฤติกรรมฝั่ง client สำหรับเว็บท่องเที่ยวประเทศจีน
// ==========================================================
document.addEventListener("DOMContentLoaded", () => {

  // ----- Reveal-on-scroll สำหรับการ์ดสถานที่ท่องเที่ยว -----
  const revealTargets = document.querySelectorAll(".card, .fact-list li");
  if ("IntersectionObserver" in window && revealTargets.length) {
    revealTargets.forEach(el => {
      el.style.opacity = 0;
      el.style.transform = "translateY(14px)";
      el.style.transition = "opacity .5s ease, transform .5s ease";
    });
    const io = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.style.opacity = 1;
          entry.target.style.transform = "translateY(0)";
          io.unobserve(entry.target);
        }
      });
    }, { threshold: 0.15 });
    revealTargets.forEach(el => io.observe(el));
  }

  // ----- ตรวจสอบฟอร์มสมัครสมาชิกฝั่ง client (เสริมจาก server-side) -----
  const registerForm = document.getElementById("registerForm");
  if (registerForm) {
    registerForm.addEventListener("submit", (e) => {
      const password = registerForm.querySelector("#password");
      const confirm = registerForm.querySelector("#confirm_password");
      const errorBox = document.getElementById("clientError");

      if (password && confirm && password.value !== confirm.value) {
        e.preventDefault();
        errorBox.textContent = "รหัสผ่านและการยืนยันรหัสผ่านไม่ตรงกัน";
        errorBox.style.display = "block";
        return;
      }
      if (password && password.value.length < 6) {
        e.preventDefault();
        errorBox.textContent = "รหัสผ่านต้องมีความยาวอย่างน้อย 6 ตัวอักษร";
        errorBox.style.display = "block";
      }
    });
  }

  // ----- ปุ่มค้นหา / กรองหมวดหมู่สถานที่ท่องเที่ยว (destinations.php) -----
  const filterButtons = document.querySelectorAll("[data-filter]");
  const cards = document.querySelectorAll("[data-category]");
  if (filterButtons.length && cards.length) {
    filterButtons.forEach(btn => {
      btn.addEventListener("click", () => {
        filterButtons.forEach(b => b.classList.remove("btn-primary"));
        btn.classList.add("btn-primary");
        const filter = btn.getAttribute("data-filter");
        cards.forEach(card => {
          const show = filter === "all" || card.getAttribute("data-category") === filter;
          card.style.display = show ? "" : "none";
        });
      });
    });
  }
});
