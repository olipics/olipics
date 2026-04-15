document.getElementById("contactForm").addEventListener("submit", function(e) {
  const name = this.name.value.trim();
  const email = this.email.value.trim();
  const message = this.message.value.trim();

  if (!name || !email || !message) {
    e.preventDefault();
    alert("Kérlek töltsd ki az összes mezőt!");
  }
});
