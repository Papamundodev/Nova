/**
 * Interactive particle canvas (#matrix-canvas on branding-design template).
 * Particles drift slowly, react to the cursor, and scatter on click.
 */
function initMatrixCanvas() {
  const canvas = document.getElementById("matrix-canvas");
  if (!canvas) return;

  // Skip on touch-only devices and when reduced motion is preferred
  const isTouchOnly = window.matchMedia("(hover: none)").matches;
  const prefersReducedMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches;
  if (isTouchOnly || prefersReducedMotion) return;

  const ctx = canvas.getContext("2d");

  // Resolve theme colors from CSS custom properties (canvas can't use var() directly)
  const styles = getComputedStyle(canvas);
  const colors = [
    styles.getPropertyValue("--primary-color").trim(),
    styles.getPropertyValue("--secondary-color").trim(),
    styles.getPropertyValue("--purple-color").trim(),
    styles.getPropertyValue("--green-color").trim(),
  ].filter(Boolean);

  // Match the drawing buffer to the element's displayed size (not the viewport)
  function resizeCanvas() {
    canvas.width = canvas.clientWidth;
    canvas.height = canvas.clientHeight;
  }
  resizeCanvas();
  window.addEventListener("resize", resizeCanvas);

  // Mouse position in canvas-local coordinates
  const mouse = { x: null, y: null, radius: 150 };

  window.addEventListener("mousemove", (e) => {
    const rect = canvas.getBoundingClientRect();
    mouse.x = e.clientX - rect.left;
    mouse.y = e.clientY - rect.top;
  });

  canvas.addEventListener("mouseleave", () => {
    mouse.x = null;
    mouse.y = null;
  });

  class Particle {
    constructor() {
      this.reset();
      this.x = Math.random() * canvas.width;
      this.y = Math.random() * canvas.height;
    }

    // Re-initialize a particle (at creation and when it leaves the canvas)
    reset() {
      this.size = Math.random() * 3 + 1;
      this.density = Math.random() * 30 + 1; // How strongly it reacts to the mouse
      this.color = colors[Math.floor(Math.random() * colors.length)];
      // Slow ambient drift
      this.vx = (Math.random() - 0.5) * 0.5;
      this.vy = (Math.random() - 0.5) * 0.5;
    }

    update() {
      this.x += this.vx;
      this.y += this.vy;

      // Push particles away from the cursor
      if (mouse.x !== null && mouse.y !== null) {
        const dx = mouse.x - this.x;
        const dy = mouse.y - this.y;
        const distance = Math.sqrt(dx * dx + dy * dy);

        if (distance < mouse.radius && distance > 0) {
          const force = (mouse.radius - distance) / mouse.radius;
          this.x += (dx / distance) * force * this.density * 0.5;
          this.y += (dy / distance) * force * this.density * 0.5;
        }
      }

      // Respawn the particle if it drifted off-canvas
      if (
        this.x < 0 ||
        this.x > canvas.width ||
        this.y < 0 ||
        this.y > canvas.height
      ) {
        this.reset();
        this.x = Math.random() * canvas.width;
        this.y = Math.random() * canvas.height;
      }
    }

    draw() {
      ctx.beginPath();
      ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
      ctx.fillStyle = this.color;
      ctx.shadowBlur = 10;
      ctx.shadowColor = this.color;
      ctx.fill();
    }
  }

  const particles = Array.from({ length: 300 }, () => new Particle());

  // Scatter particles on click
  canvas.addEventListener("click", () => {
    particles.forEach((p) => {
      p.x += (Math.random() - 0.5) * 300;
      p.y += (Math.random() - 0.5) * 300;
    });
  });

  function animate() {
    // Fade the previous frame without painting a solid background:
    // destination-out keeps the motion trail while leaving the canvas transparent
    ctx.shadowBlur = 0;
    ctx.globalCompositeOperation = "destination-out";
    ctx.fillStyle = "rgba(0, 0, 0, 0.2)";
    ctx.fillRect(0, 0, canvas.width, canvas.height);
    ctx.globalCompositeOperation = "source-over";

    particles.forEach((p) => {
      p.update();
      p.draw();
    });

    requestAnimationFrame(animate);
  }

  animate();
}

document.addEventListener("DOMContentLoaded", initMatrixCanvas);
