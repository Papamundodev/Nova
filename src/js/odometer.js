import Odometer from "odometer";

Odometer.options.auto = false;

function initBorderAnimations() {
  const borderAnimations = document.querySelectorAll(
    ".border-animation[data-pourcentage]"
  );
  if (borderAnimations.length === 0) {
    return;
  }

  const prefersReduce =
    window.matchMedia?.("(prefers-reduced-motion: reduce)")?.matches;

  const initBorderOdometer = (borderEl, target) => {
    const odEl = borderEl.querySelector(
      ".border-odometer.odometer[data-odometer-value]"
    );
    if (!odEl) return null;

    if (odEl.dataset.odometerInit === "1") return null;
    odEl.dataset.odometerInit = "1";

    const rawTarget = odEl.dataset.odometerValue ?? String(target ?? "0");
    const targetNumber = Math.min(100, Math.max(0, parseFloat(rawTarget)));
    if (!Number.isFinite(targetNumber)) return null;

    odEl.textContent = "0";

    const od = new Odometer({
      el: odEl,
      value: 0,
      duration: 2000,
      theme: "default",
      format: "d",
    });

    return () => od.update(targetNumber);
  };

  const apply = (el) => {
    const pourcentage = parseFloat(el.dataset.pourcentage);
    if (isNaN(pourcentage)) {
      return;
    }

    const degree = (pourcentage / 100) * 360;
    el.style.setProperty("--pourcentage", pourcentage + "%");
    el.style.setProperty("--degree", degree + "deg");

    if (prefersReduce) {
      el.classList.add("is-animated");
      const odTrigger = initBorderOdometer(el, pourcentage);
      if (odTrigger) odTrigger();
      return;
    }

    const odTrigger = initBorderOdometer(el, pourcentage);

    requestAnimationFrame(() => {
      el.classList.add("is-animated");
      if (odTrigger) odTrigger();
    });
  };

  if ("IntersectionObserver" in window && !prefersReduce) {
    const borderObserver = new IntersectionObserver(
      (entries, observer) => {
        entries.forEach((entry) => {
          if (!entry.isIntersecting) return;
          apply(entry.target);
          observer.unobserve(entry.target);
        });
      },
      { rootMargin: "0px 0px -10% 0px", threshold: 0.15 }
    );

    borderAnimations.forEach((el) => borderObserver.observe(el));
  } else {
    borderAnimations.forEach((el) => apply(el));
  }
}

document.addEventListener("DOMContentLoaded", () => {
  initBorderAnimations();
});
