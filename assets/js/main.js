document.addEventListener("DOMContentLoaded", () => {
  const burger = document.querySelector("#theme-navbar-toggler");
  const popover = document.getElementById("navmenu-header-mobile");
  burger.addEventListener("click", () => {
    burger.classList.toggle("open");
  });
  popover.addEventListener("toggle", (event) => {
    if (event.newState === "closed") {
      burger.classList.remove("open");
    }
  });
  document.addEventListener("mouseover", function(a) {
    const o = a.target.closest(".button-background-animation");
    if (o) {
      const c = o.querySelector(".hover-bg");
      if (c) {
        const v = o.getBoundingClientRect(), h = a.clientX - v.left, s = a.clientY - v.top;
        c.style.setProperty("--creative-hover-top", `${s}px`), c.style.setProperty("--creative-hover-left", `${h}px`);
      }
    }
  });
  const segmenter = new Intl.Segmenter("en", { granularity: "grapheme" });
  function getLetters(name) {
    const text = name;
    const segments = Array.from(segmenter.segment(text));
    return segments.map((segment) => segment.segment);
  }
  function mouseOver(element) {
    element.addEventListener("mouseover", function(event) {
      getLetters(element.dataset.name);
      let letterIndex = 0;
      const spans = element.querySelectorAll("span");
      spans.forEach((span) => {
        span.style.transitionDelay = `${letterIndex * 0.015}s`;
        letterIndex++;
      });
    });
  }
  document.querySelectorAll(".button-wave-animation button").forEach((a) => {
    const letters = getLetters(a.dataset.name);
    let htmlContent = "";
    letters.forEach((letter) => {
      if (letter === " ") {
        htmlContent += `<span>&nbsp;</span>`;
      } else {
        htmlContent += `<span>${letter}</span>`;
      }
    });
    a.innerHTML = htmlContent + a.innerHTML;
  });
  document.querySelectorAll(".button-wave-animation button").forEach((a) => {
    mouseOver(a);
  });
});
//# sourceMappingURL=main.js.map
