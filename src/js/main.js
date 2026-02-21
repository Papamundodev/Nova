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
          const v = o.getBoundingClientRect()
            , h = a.clientX - v.left
            , s = a.clientY - v.top;
              c.style.setProperty("--creative-hover-top", `${s}px`),
              c.style.setProperty("--creative-hover-left", `${h}px`)
      }
  }
});

  /**
   * Cursor-following blur effect in .section-intro
   * animation-moving-item can be in header or section - find it from document
   */
  const sectionIntro = document.querySelector(".section-intro");
  const sectionFooter = document.querySelector(".section-footer");
  const cursorFollowItem = document.querySelector(".animation-moving-item");

  if (sectionIntro && cursorFollowItem || sectionFooter && cursorFollowItem) {

    sectionIntro.addEventListener("mouseenter", () => {
      cursorFollowItem.classList.add("animation-moving-item--cursor-follow");
    });
    sectionFooter.addEventListener("mouseenter", () => {
      cursorFollowItem.classList.add("animation-moving-item--cursor-follow");
    });

    sectionIntro.addEventListener("mousemove", (e) => {
      document.documentElement.style.setProperty("--mouse-x", `${e.clientX}px`);
      document.documentElement.style.setProperty("--mouse-y", `${e.clientY}px`);
    });
    sectionFooter.addEventListener("mousemove", (e) => {
      document.documentElement.style.setProperty("--mouse-x", `${e.clientX}px`);
      document.documentElement.style.setProperty("--mouse-y", `${e.clientY}px`);
    });

    sectionIntro.addEventListener("mouseleave", () => {
      cursorFollowItem.classList.remove("animation-moving-item--cursor-follow");
    });
    sectionFooter.addEventListener("mouseleave", () => {
      cursorFollowItem.classList.remove("animation-moving-item--cursor-follow");
    });
  }



scrollers = document.querySelectorAll('.scroller');
if (scrollers.length > 0) {
  addInfiniteScroll();
}

function addInfiniteScroll() {
    scrollers.forEach(scroller => {
      scroller.setAttribute('data-infinite-scroll', 'true');
      const scrollerInner = scroller.querySelector('.scroller-inner');
      const scrollerContent = Array.from(scrollerInner.children);
      scrollerContent.forEach(child => {
        let duplicatedChild = child.cloneNode(true);
        duplicatedChild.setAttribute('aria-hidden', 'true');
        scrollerInner.appendChild(duplicatedChild);
      });
            scrollerContent.forEach(child => {
        let duplicatedChild = child.cloneNode(true);
        duplicatedChild.setAttribute('aria-hidden', 'true');
        scrollerInner.appendChild(duplicatedChild);
      });
    });
}

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

