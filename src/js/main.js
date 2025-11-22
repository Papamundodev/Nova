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

        // Create a segmenter instance for grapheme (letter) segmentation
    const segmenter = new Intl.Segmenter('en', { granularity: 'grapheme' });

    function getLetters(name) {
    const text = name;
    const segments = Array.from(segmenter.segment(text));
    return segments.map(segment => segment.segment);
    }

    function mouseLeave(element) {
      element.addEventListener("mouseleave", function(event) {
          const spans = event.currentTarget.querySelectorAll("span");
            spans.forEach(span => {
              span.style.transitionDelay = "0s";
          });
      });
    }


    function mouseOver(element) {
      element.addEventListener("mouseover", function(event) {
        const letters = getLetters(element.dataset.name);
        let letterIndex = 0;
        const spans = element.querySelectorAll("span");
        spans.forEach(span => {
          span.style.transitionDelay = `${letterIndex * 0.01  }s`;
          letterIndex++;
        });
      });
    }

    document.querySelectorAll('.button-wave-animation button, .button-wave-animation a').forEach(a => {
    const letters = getLetters(a.dataset.name);
    let letterIndex = 0; // Track index only for non-space characters
    let htmlContent = ''; // Build HTML string first

    letters.forEach((letter) => {
        if (letter === ' ') {
            // Spaces get no delay - use &nbsp; to ensure visibility
            htmlContent += `<span>&nbsp;</span>`;
        } else {
            // Letters get animation delay (1s base delay + staggered delay per letter)
            htmlContent += `<span>${letter}</span>`;
            letterIndex++;
        }
    });

    // Replace innerHTML with the built content (this will add spans before any existing content)
    a.innerHTML = htmlContent + a.innerHTML;
    });


  document.querySelectorAll('.button-wave-animation button, .button-wave-animation a').forEach(a => {
    //mouseLeave(a);
    mouseOver(a);
  });


class Slider {
    constructor(el) {
        this.nextButton = el.querySelector('[data-slider-next]');
        this.prevButton = el.querySelector('[data-slider-prev]');
        this.wrapper = el.querySelector('[data-slider-wrapper]');
        this.nextButton.addEventListener('click', () => this.move(1));
        this.prevButton.addEventListener('click', () => this.move(-1));
        this.updateUi();
        this.wrapper.addEventListener('scroll', (event) => {
            this.updateUi() 

        if (this.previousPage()) {
            this.previousPage().classList.remove('fade-in');
            this.previousPage().classList.add('fade-out');
        }
        if (this.currentPage()) {
            this.currentPage().classList.add('fade-in');
            this.currentPage().classList.remove('fade-out');
        }
        if (this.nextPage()) {
            this.nextPage().classList.remove('fade-in');
            this.nextPage().classList.add('fade-out');
        }
        });
    }


    get pages() {
        return this.wrapper.children.length;
    }

    get page() {
        return Math.round(this.wrapper.scrollLeft / this.wrapper.offsetWidth);
    }

    updateUi() {
        if (this.page === 0) {
            this.prevButton.setAttribute('hidden', "hidden");
        } else {
            this.prevButton.removeAttribute('hidden');
        }

        if (this.page === this.pages - 1) {
            this.nextButton.setAttribute('hidden', "hidden");
        } else {
            this.nextButton.removeAttribute('hidden');
        }



    }

    move(n) {
        let newPage = this.page + n;
        if (newPage < 0) {
            newPage = 0;
        }
        if (newPage >= this.pages) {
            newPage = this.pages - 1;
        }
        this.wrapper.scrollTo({
            left: this.wrapper.children[newPage].offsetLeft,
            behavior: 'smooth'
        });
    }

    currentPage() {
        return this.wrapper.children[this.page];
    }

    previousPage() {
        return this.wrapper.children[this.page - 1];
    }

    nextPage() {
        return this.wrapper.children[this.page + 1];
    }
}

if (document.querySelector('[data-slider]') !== null) {
    new Slider(document.querySelector('[data-slider]'));
}
});


