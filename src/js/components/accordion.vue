<template>
    <div class="accordion__container">
        <slot />
    </div>
</template>

<script>
    export default {
        name: 'accordion',
        methods: {
            /**
             * @description Build the accordions functionality
             * @author Keith Murphy | nomadmystics@gmail.com
             * Shamelessly stolen from https://www.w3schools.com/howto/howto_js_accordion.asp
             *
             * @return void
             */
            buildAccordions() {
                const accordionTitle = document.getElementsByClassName('accordion-title');
                let i;

                if (accordionTitle) {
                    for (i = 0; i < accordionTitle.length; i++) {
                        accordionTitle[i].addEventListener('click', function() {
                            /* Toggle between adding and removing the 'active' class,
                            to highlight the button that controls the panel */
                            this.classList.toggle('active');

                            /* Toggle between hiding and showing the active panel */
                            let panel = this.nextElementSibling;

                            if (panel.style.display === 'block') {

                                panel.style.display = 'none';

                            } else {
                                panel.style.display = 'block';

                            }
                        });
                    }
                }
            },
        },
        mounted() {

            window.addEventListener('DOMContentLoaded', this.buildAccordions);

        },
    };
</script>
