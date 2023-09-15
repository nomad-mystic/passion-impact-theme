<template>
    <div class="slider-component">
        <slot/>
    </div>
</template>

<script>
    export default {
        name: 'slider',
        props: {
            selector: {
                default: '',
                type: String,
            },
            interval: {
                default: '',
                type: String,
            },
            shouldChange: {
                default: 'false',
                type: String,
            },
        },
        methods: {
            /**
             * @description Create the home page slider
             * @author Keith Murphy | nomadmystics@gmail.com
             * @link https://levelup.gitconnected.com/create-an-image-slider-with-html-css-and-javascript-3bf2c3e84060
             *
             * @return void
             */
            buildSlider() {
                let currentSlide = 0;
                const slides = document.querySelectorAll(`.${this.selector} .slide`);
                const dots = document.querySelectorAll(`.${this.selector} .pagination li`);
                const nextButton = window.document.querySelector(`.${this.selector} .next`);
                const prevButton = window.document.querySelector(`.${this.selector} .prev`);

                const init = (n) => {
                    if (slides) {
                        slides.forEach((slide) => {
                            slide.style.display = 'none';

                            if (dots) {
                                dots.forEach((dot) => {
                                    dot.classList.remove('active');
                                });
                            }
                        });

                        slides[n].style.display = 'block';

                        if (dots) {
                            dots[n].classList.add('active');
                        }
                    }
                }
                init(currentSlide);

                if (dots) {
                    dots.forEach((dot, index) => {
                        dot.addEventListener("click", () => {
                            init(index);
                            currentSlide = index;
                        })
                    });
                }

                const next = () => {
                    currentSlide >= slides.length - 1 ? currentSlide = 0 : currentSlide++;
                    init(currentSlide);
                };

                const prev = () => {
                    currentSlide <= 0 ? currentSlide = slides.length - 1 : currentSlide--
                    init(currentSlide);
                };

                // Next
                nextButton.addEventListener('click', next, false);

                // Prev
                prevButton.addEventListener('click', prev, false);

                if (this.shouldChange === 'true') {
                    setInterval(() => {
                        next();
                    }, Number(this.interval * 1000));
                }
            },
        },
        mounted() {

            this.buildSlider();

        },
    }
</script>
