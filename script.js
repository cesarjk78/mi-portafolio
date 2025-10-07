// ===== Parallax =====
window.addEventListener('scroll', () => {
    const value = window.scrollY;
    document.getElementById('nubes').style.transform = `translateX(${value * 0.3}px)`;
    document.getElementById('palmera1').style.transform = `translateX(${value * 0.5}px)`;
    document.getElementById('palmera2').style.transform = `translateX(-${value * 0.5}px)`;
    document.getElementById('text').style.marginTop = value * 1.5 + 'px';
  });
  
  // ===== Fondo de partículas =====
  const canvas = document.getElementById('particles');
  const ctx = canvas.getContext('2d');
  
  // 🔹 Función para ajustar el tamaño del canvas
  function resizeCanvas() {
    canvas.width = window.innerWidth;
    const sec = document.querySelector('.sec');
    canvas.height = sec.scrollHeight; // Ajusta al tamaño total de la sección
  }
  
  // 🔹 Llamar cuando todo el contenido esté cargado
  window.addEventListener('load', resizeCanvas);
  window.addEventListener('resize', resizeCanvas);
  
  // 🔹 Generar partículas
  const particles = [];
  const numParticles = 70;
  
  for (let i = 0; i < numParticles; i++) {
    particles.push({
      x: Math.random() * window.innerWidth,
      y: Math.random() * window.innerHeight,
      radius: Math.random() * 2 + 1,
      dx: (Math.random() - 0.5) * 0.6,
      dy: (Math.random() - 0.5) * 0.6,
    });
  }
  
  // 🔹 Dibujar partículas
  function drawParticles() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    ctx.fillStyle = 'rgba(255, 167, 38, 0.5)';
    
    particles.forEach(p => {
      ctx.beginPath();
      ctx.arc(p.x, p.y, p.radius, 0, Math.PI * 2);
      ctx.fill();
  
      p.x += p.dx;
      p.y += p.dy;
  
      // Rebote en los bordes
      if (p.x < 0 || p.x > canvas.width) p.dx *= -1;
      if (p.y < 0 || p.y > canvas.height) p.dy *= -1;
    });
  
    requestAnimationFrame(drawParticles);
  }
  
  // 🔹 Iniciar animación después de que se ajuste el tamaño ctx.fillStyle = 'rgba(255, 167, 38, 0.5)';
  window.addEventListener('load', () => {
    resizeCanvas();
    drawParticles();
  });
  