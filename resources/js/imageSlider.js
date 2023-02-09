class Slider {
    constructor(slider) {
        this.slider = slider;
        this.slides = this.slider.querySelectorAll(".slide");
        this.current = 0;
        this.prev = this.slides.length - 1;
        this.next = 1;
    }

    changeSlide(offset) {
        this.current += offset;
        if (this.current < 0) {
            this.current = this.slides.length - 1;
        }
        if (this.current > this.slides.length - 1) {
            this.current = 0
        }

        this.prev = this.current - 1;
        this.next = this.current + 1;

        if (this.next > this.slides.length - 1) {
            this.next = 0;
        };
        if (this.prev < 0) {
            this.prev = this.slides.length - 1;
        };
        this.animate();
    }
    animate () {
        for (let i=0; i < this.slides.length; i++) {
            this.slides[i].classList.remove("prev-slide");
            this.slides[i].classList.remove("current-slide");
            this.slides[i].classList.remove("next-slide");
        }

        this.slides[this.prev].classList.add("prev-slide");
        this.slides[this.current].classList.add("current-slide");
        this.slides[this.next].classList.add("next-slide");
    }
}

//  Getting all sliders on the page so the slider logic could be applied to all of them
const sliders = document.querySelectorAll(".slider");

sliders.forEach((slider) => {
    const prevBtn = slider.querySelector(".prev-btn");
    const nextBtn = slider.querySelector(".next-btn");

    const sliderObject = new Slider(slider);

    if (sliderObject.slides.length >= 3) {
        sliderObject.slides[sliderObject.prev].classList.add("prev-slide");
        sliderObject.slides[sliderObject.current].classList.add("current-slide");
        sliderObject.slides[sliderObject.next].classList.add("next-slide");
    } else if (sliderObject.slides.length == 2) {
        sliderObject.slides[0].classList.add("translated-slide-right");
        sliderObject.slides[1].classList.add("translated-slide-left");
    } else {
        sliderObject.slides[0].classList.add("current-slide");
    }

    if (nextBtn) {
        nextBtn.addEventListener("click", () => {
            sliderObject.changeSlide(1);
        });
    }
    if (prevBtn) {
        prevBtn.addEventListener("click", () => {
            sliderObject.changeSlide(-1);
        });
    }
});
