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
        span.style.transitionDelay = `${letterIndex * 0.012}s`;
        letterIndex++;
      });
    });
  }
  document.querySelectorAll(".button-wave-animation button, .button-wave-animation a").forEach((a) => {
    const textElement = a.querySelector(".button-text");
    const textContent = textElement ? textElement.textContent : a.dataset.name || "";
    if (!textContent)
      return;
    const letters = getLetters(textContent);
    let htmlContent = "";
    letters.forEach((letter) => {
      if (letter === " ") {
        htmlContent += `<span>&nbsp;</span>`;
      } else {
        htmlContent += `<span>${letter}</span>`;
      }
    });
    if (textElement) {
      textElement.outerHTML = htmlContent;
    } else {
      const svgContent = a.querySelector("svg") ? a.querySelector("svg").outerHTML : "";
      a.innerHTML = htmlContent + svgContent;
    }
  });
  document.querySelectorAll(".button-wave-animation button, .button-wave-animation a").forEach((a) => {
    mouseOver(a);
  });
  class Slider {
    constructor(el) {
      this.wrapper = el.querySelector("[data-slider-wrapper]");
      this.bullets = Array.from(el.querySelectorAll("[data-slider-bullet]"));
      this.slides = Array.from(this.wrapper.querySelectorAll(".slide"));
      this.zIndex = this.slides.length;
      this.currentPage = 0;
      this.slides.forEach((slide, i) => slide.style.zIndex = i + 1);
      this.updateBullets();
      el.addEventListener("click", (e) => {
        const bullet = e.target.closest("[data-slider-bullet]");
        if (bullet)
          this.goToSlide(parseInt(bullet.dataset.sliderBullet));
      });
      let timeout;
      this.wrapper.addEventListener("scroll", () => {
        clearTimeout(timeout);
        timeout = setTimeout(() => this.updateFadeClasses(), 16);
      });
      this.updateBullets();
    }
    getSlide(number) {
      return this.slides.find(
        (slide) => parseInt(slide.getAttribute("slide-number")) === number
      );
    }
    goToSlide(number) {
      const slide = this.getSlide(number);
      if (!slide || this.currentPage === number)
        return;
      this.zIndex++;
      slide.style.zIndex = this.zIndex;
      this.currentPage = number;
      this.updateBullets();
      this.updateFadeClasses();
    }
    updateBullets() {
      this.bullets.forEach((bullet, i) => {
        bullet.classList.toggle("slide-bullet-active", i === this.currentPage);
      });
    }
    updateFadeClasses() {
      this.slides.forEach((slide) => {
        slide.classList.remove("fade-in", "fade-out");
      });
      const prev = this.getSlide(this.currentPage - 1);
      const current = this.getSlide(this.currentPage);
      const next = this.getSlide(this.currentPage + 1);
      if (prev)
        prev.classList.add("fade-out");
      if (current)
        current.classList.add("fade-in");
      if (next)
        next.classList.add("fade-out");
    }
  }
  if (document.querySelector("[data-slider]") !== null) {
    new Slider(document.querySelector("[data-slider]"));
  }
  scrollers = document.querySelectorAll(".scroller");
  if (scrollers.length > 0) {
    addInfiniteScroll();
  }
  function addInfiniteScroll() {
    scrollers.forEach((scroller) => {
      scroller.setAttribute("data-infinite-scroll", "true");
      const scrollerInner = scroller.querySelector(".scroller-inner");
      const scrollerContent = Array.from(scrollerInner.children);
      scrollerContent.forEach((child) => {
        let duplicatedChild = child.cloneNode(true);
        duplicatedChild.setAttribute("aria-hidden", "true");
        scrollerInner.appendChild(duplicatedChild);
      });
      scrollerContent.forEach((child) => {
        let duplicatedChild = child.cloneNode(true);
        duplicatedChild.setAttribute("aria-hidden", "true");
        scrollerInner.appendChild(duplicatedChild);
      });
    });
  }
  let scrollTop = document.querySelector(".scroll-top");
  function toggleScrollTop() {
    if (scrollTop) {
      window.scrollY > 100 ? scrollTop.classList.add("active") : scrollTop.classList.remove("active");
    }
  }
  scrollTop.addEventListener("click", (e) => {
    e.preventDefault();
    window.scrollTo({
      top: 0,
      behavior: "smooth"
    });
  });
  window.addEventListener("load", toggleScrollTop);
  document.addEventListener("scroll", toggleScrollTop);
});
//# sourceMappingURL=main.js.map
