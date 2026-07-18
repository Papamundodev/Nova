import "./odometer.js";

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

  popover.addEventListener("click", (e) => {
    if (e.target.closest("a")) {
      popover.hidePopover();
    }
  });


  document.addEventListener("mouseover", function(a) {
  const o = a.target.closest(".button-background-animation");
  if (o) {
      const c = o.querySelector(".hover-bg");
      if (c) {
          const v = o.getBoundingClientRect()
            , h = a.clientX - v.left
            , s = a.clientY - v.top;
              c.style.setProperty("--creative-hover-top", `${s}px`),
              c.style.setProperty("--creative-hover-left", `${h}px`)
      }
  }

  const sliderFeaturedPosts = document.querySelector("[data-slider-featured-posts]");
  if (sliderFeaturedPosts) {
    new SliderPrevNextDesktopFeaturedPosts(sliderFeaturedPosts);
  }

  const sliderRelatedPosts = document.querySelector("[data-slider-related-posts]");
  if (sliderRelatedPosts) {
    new SliderPrevNextDesktopRelatedPosts(sliderRelatedPosts);
  }

  document.querySelectorAll("[data-slider-gallery]").forEach((el) => {
    new SliderPrevNextGallery(el);
  });
});



  /**
   * Cursor-following blur effect in .section-intro
   * animation-moving-item can be in header or section - find it from document
   */

  const cursorFollowItem = document.querySelector(".animation-moving-item");
  const sectionLight = document.querySelectorAll(".section-light");

  if (sectionLight && cursorFollowItem && sectionLight.length > 0) {
    sectionLight.forEach(section => {
      section.addEventListener("mouseenter", () => {
        if (document.body.classList.contains("dark-theme")) {
          cursorFollowItem.classList.add("animation-moving-item--cursor-follow");
        }
      });

      section.addEventListener("mousemove", (e) => {
        if (document.body.classList.contains("dark-theme")) {
          document.documentElement.style.setProperty("--mouse-x", `${e.clientX}px`);
          document.documentElement.style.setProperty("--mouse-y", `${e.clientY}px`);
        }
      });

      section.addEventListener("mouseleave", () => {
        cursorFollowItem.classList.remove("animation-moving-item--cursor-follow");
      });
    });

    // Remove cursor effect when switching to light theme
    const themeObserver = new MutationObserver(() => {
      if (!document.body.classList.contains("dark-theme")) {
        cursorFollowItem.classList.remove("animation-moving-item--cursor-follow");
      }
    });
    themeObserver.observe(document.body, { attributes: true, attributeFilter: ["class"] });
  }

  /**
   * Cursor-following effect for .interactive when hovering .gradient-container
   */
  const gradientContainer = document.querySelector(".gradient-container");
  const interactiveItem = document.querySelector(".gradient-container .interactive");

  if (gradientContainer && interactiveItem) {
    gradientContainer.addEventListener("mouseenter", () => {
      interactiveItem.classList.add("interactive--cursor-follow");
    });

    gradientContainer.addEventListener("mousemove", (e) => {
      document.documentElement.style.setProperty("--mouse-x", `${e.clientX}px`);
      document.documentElement.style.setProperty("--mouse-y", `${e.clientY}px`);
    });

    gradientContainer.addEventListener("mouseleave", () => {
      interactiveItem.classList.remove("interactive--cursor-follow");
    });
  }


const scrollers = document.querySelectorAll(".scroller");
if (scrollers.length > 0) {
  addInfiniteScroll();
}

function addInfiniteScroll() {
  scrollers.forEach((scroller) => {
    scroller.setAttribute("data-infinite-scroll", "true");
    const scrollerInner = scroller.querySelector(".scroller-inner");
    const scrollerContent = Array.from(scrollerInner.children);
    scroller.dataset.originalCount = String(scrollerContent.length);

    // Speed: base is 30s for 5 items (≈ 6s per item)
    const baseItems = 5;
    const baseSeconds = 30;
    const count = scrollerContent.length;
    const durationSeconds = (count / baseItems) * baseSeconds;
    const minSeconds = 12;
    const maxSeconds = 120;
    const finalSeconds = Math.min(maxSeconds, Math.max(minSeconds, durationSeconds));
    scroller.style.setProperty("--scroll-duration", `${finalSeconds}s`);

    setScrollDistance(scroller);
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

function setScrollDistance(scroller) {
  const scrollerInner = scroller.querySelector(".scroller-inner");
  const originalCount = Number(scroller.dataset.originalCount || 0);
  if (originalCount === 0) {
    return;
  }
  const children = Array.from(scrollerInner.children).slice(0, originalCount);
  const originalWidth = children.reduce((total, child) => {
    return total + child.getBoundingClientRect().width;
  }, 0);
  if (originalWidth > 0) {
    scroller.style.setProperty("--scroll-distance", `${originalWidth}px`);
  }
}

window.addEventListener("load", () => {
  scrollers.forEach((scroller) => {
    setScrollDistance(scroller);
  });
});

  /**
   * Scroll top button
   */
  let scrollTop = document.querySelector(".scroll-top");

  function toggleScrollTop() {
    if (scrollTop) {
      window.scrollY > 100
        ? scrollTop.classList.add("active")
        : scrollTop.classList.remove("active");
    }
  }
  scrollTop.addEventListener("click", (e) => {
    e.preventDefault();
    window.scrollTo({
      top: 0,
      behavior: "smooth",
    });
  });

  window.addEventListener("load", toggleScrollTop);
  document.addEventListener("scroll", toggleScrollTop);
});





function scrollDetailsIntoView(details) {
  requestAnimationFrame(() => {
    details.scrollIntoView({ behavior: "smooth", block: "start" });
  });
}

function bindMobileScrollForDetails(selector) {
  const detailsEls = document.querySelectorAll(selector);
  if (!detailsEls.length) return;

  detailsEls.forEach((details) => {
    details.addEventListener("toggle", () => {
      if (!details.open) return;
      scrollDetailsIntoView(details);
    });
  });
}

document.addEventListener("DOMContentLoaded", () => {
  bindMobileScrollForDetails('details.dropdown-details[id^="faq-details-"]');
});





class SliderPrevNextGallery {
  constructor(el) {
    this.nextButton = el.querySelector("[data-slider-next-gallery]");
    this.prevButton = el.querySelector("[data-slider-prev-gallery]");
    this.wrapper = el.querySelector("[data-slider-wrapper-gallery]");
    if (!this.nextButton || !this.prevButton || !this.wrapper) return;
    this.nextButton.addEventListener("click", () => this.move(1));
    this.prevButton.addEventListener("click", () => this.move(-1));
    this.updateUi();
    this.wrapper.addEventListener("scroll", () => {
      this.updateUi();
    });
  }
  get itemToScroll() {
    return parseInt(window.getComputedStyle(this.wrapper).getPropertyValue("--items"), 10);
  }
  updateUi() {
    const scrollLeft = this.wrapper.scrollLeft;
    const scrollWidth = this.wrapper.scrollWidth;
    const offsetWidth = this.wrapper.offsetWidth;
    if (scrollLeft <= 1) {
      this.prevButton.setAttribute("hidden", "hidden");
    } else {
      this.prevButton.removeAttribute("hidden");
    }
    if (scrollLeft + offsetWidth >= scrollWidth - 1) {
      this.nextButton.setAttribute("hidden", "hidden");
    } else {
      this.nextButton.removeAttribute("hidden");
    }
  }
  move(n) {
    const itemToScroll = this.itemToScroll;
    const currentScrollLeft = this.wrapper.scrollLeft;
    const offsetWidth = this.wrapper.offsetWidth;
    const scrollWidth = this.wrapper.scrollWidth;
    const children = Array.from(this.wrapper.children || []);
    let currentIndex = 0;
    const isAtEnd = currentScrollLeft + offsetWidth >= scrollWidth - 1;

    if (isAtEnd) {
      const lastAlignedGroupStart = Math.floor((children.length - 1) / itemToScroll) * itemToScroll;
      const lastPossibleGroupStart = Math.max(0, children.length - itemToScroll);
      currentIndex = Math.min(lastAlignedGroupStart, lastPossibleGroupStart);
    } else {
      let firstVisibleIndex = 0;
      for (let i = 0; i < children.length; i++) {
        if (children[i].offsetLeft >= currentScrollLeft) {
          firstVisibleIndex = i;
          break;
        }
      }
      currentIndex = Math.floor(firstVisibleIndex / itemToScroll) * itemToScroll;
    }

    let targetIndex = currentIndex + n * itemToScroll;
    let scrollPosition;
    if (targetIndex < 0) {
      scrollPosition = 0;
    } else if (targetIndex >= this.wrapper.children.length) {
      const lastIndex = this.wrapper.children.length - itemToScroll;
      scrollPosition = this.wrapper.children[lastIndex].offsetLeft;
    } else {
      scrollPosition = this.wrapper.children[targetIndex].offsetLeft;
    }
    this.wrapper.scrollTo({
      left: scrollPosition,
      behavior: "smooth",
    });
  }
}




class SliderPrevNextDesktopFeaturedPosts {
  constructor(el) {
    this.nextButton = el.querySelector("[data-slider-next-featured-posts]");
    this.prevButton = el.querySelector("[data-slider-prev-featured-posts]");
    this.wrapper = el.querySelector("[data-slider-wrapper-featured-posts]");
    this.nextButton.addEventListener("click", () => this.move(1));
    this.prevButton.addEventListener("click", () => this.move(-1));
    this.updateUi();
    this.wrapper.addEventListener("scroll", () => {
      this.updateUi();
    });
  }
  get itemToScroll() {
    return parseInt(window.getComputedStyle(this.wrapper).getPropertyValue("--items"), 10);
  }
  updateUi() {
    const scrollLeft = this.wrapper.scrollLeft;
    const scrollWidth = this.wrapper.scrollWidth;
    const offsetWidth = this.wrapper.offsetWidth;
    if (scrollLeft <= 1) {
      this.prevButton.setAttribute("hidden", "hidden");
    } else {
      this.prevButton.removeAttribute("hidden");
    }
    if (scrollLeft + offsetWidth >= scrollWidth - 1) {
      this.nextButton.setAttribute("hidden", "hidden");
    } else {
      this.nextButton.removeAttribute("hidden");
    }
  }
  move(n) {
    const itemToScroll = this.itemToScroll;
    const currentScrollLeft = this.wrapper.scrollLeft;
    const offsetWidth = this.wrapper.offsetWidth;
    const scrollWidth = this.wrapper.scrollWidth;
    const children = Array.from(this.wrapper.children || []);
    let currentIndex = 0;
    const isAtEnd = currentScrollLeft + offsetWidth >= scrollWidth - 1;

    if (isAtEnd) {
      const lastAlignedGroupStart = Math.floor((children.length - 1) / itemToScroll) * itemToScroll;
      const lastPossibleGroupStart = Math.max(0, children.length - itemToScroll);
      currentIndex = Math.min(lastAlignedGroupStart, lastPossibleGroupStart);
    } else {
      let firstVisibleIndex = 0;
      for (let i = 0; i < children.length; i++) {
        if (children[i].offsetLeft >= currentScrollLeft) {
          firstVisibleIndex = i;
          break;
        }
      }
      currentIndex = Math.floor(firstVisibleIndex / itemToScroll) * itemToScroll;
    }

    let targetIndex = currentIndex + n * itemToScroll;
    let scrollPosition;
    if (targetIndex < 0) {
      scrollPosition = 0;
    } else if (targetIndex >= this.wrapper.children.length) {
      const lastIndex = this.wrapper.children.length - itemToScroll;
      scrollPosition = this.wrapper.children[lastIndex].offsetLeft;
    } else {
      scrollPosition = this.wrapper.children[targetIndex].offsetLeft;
    }
    this.wrapper.scrollTo({
      left: scrollPosition,
      behavior: "smooth",
    });
  }
}



class SliderPrevNextDesktopRelatedPosts {
  constructor(el) {
    this.nextButton = el.querySelector("[data-slider-next-related-posts]");
    this.prevButton = el.querySelector("[data-slider-prev-related-posts]");
    this.wrapper = el.querySelector("[data-slider-wrapper-related-posts]");
    this.nextButton.addEventListener("click", () => this.move(1));
    this.prevButton.addEventListener("click", () => this.move(-1));
    this.updateUi();
    this.wrapper.addEventListener("scroll", () => {
      this.updateUi();
    });
  }
  get itemToScroll() {
    return parseInt(window.getComputedStyle(this.wrapper).getPropertyValue("--items"), 10);
  }
  updateUi() {
    const scrollLeft = this.wrapper.scrollLeft;
    const scrollWidth = this.wrapper.scrollWidth;
    const offsetWidth = this.wrapper.offsetWidth;
    if (scrollLeft <= 1) {
      this.prevButton.setAttribute("hidden", "hidden");
    } else {
      this.prevButton.removeAttribute("hidden");
    }
    if (scrollLeft + offsetWidth >= scrollWidth - 1) {
      this.nextButton.setAttribute("hidden", "hidden");
    } else {
      this.nextButton.removeAttribute("hidden");
    }
  }
  move(n) {
    const itemToScroll = this.itemToScroll;
    const currentScrollLeft = this.wrapper.scrollLeft;
    const offsetWidth = this.wrapper.offsetWidth;
    const scrollWidth = this.wrapper.scrollWidth;
    const children = Array.from(this.wrapper.children || []);
    let currentIndex = 0;
    const isAtEnd = currentScrollLeft + offsetWidth >= scrollWidth - 1;

    if (isAtEnd) {
      const lastAlignedGroupStart = Math.floor((children.length - 1) / itemToScroll) * itemToScroll;
      const lastPossibleGroupStart = Math.max(0, children.length - itemToScroll);
      currentIndex = Math.min(lastAlignedGroupStart, lastPossibleGroupStart);
    } else {
      let firstVisibleIndex = 0;
      for (let i = 0; i < children.length; i++) {
        if (children[i].offsetLeft >= currentScrollLeft) {
          firstVisibleIndex = i;
          break;
        }
      }
      currentIndex = Math.floor(firstVisibleIndex / itemToScroll) * itemToScroll;
    }

    let targetIndex = currentIndex + n * itemToScroll;
    let scrollPosition;
    if (targetIndex < 0) {
      scrollPosition = 0;
    } else if (targetIndex >= this.wrapper.children.length) {
      const lastIndex = this.wrapper.children.length - itemToScroll;
      scrollPosition = this.wrapper.children[lastIndex].offsetLeft;
    } else {
      scrollPosition = this.wrapper.children[targetIndex].offsetLeft;
    }
    this.wrapper.scrollTo({
      left: scrollPosition,
      behavior: "smooth",
    });
  }
}


