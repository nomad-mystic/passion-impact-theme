<template>
    <div class="primary-nav-component">
        <slot />
    </div>
</template>

<script>
    export default {
        name: 'primary-nav-mobile',
        data() {
            return {
                closeButton: '',
                openButton: '',
            };
        },
        methods: {
            /**
             * @author Keith Murphy | nomadmystics@gmail.com
             * @description Toggle the mobile nav's visibility
             *
             * @return void
             */
            toggleMenu() {
                const primaryMenu = window.document.getElementById('nav-primary-menu-container');
                const bodyElement = window.document.body;

                this.closeButton.addEventListener('click', function(event) {
                    const target = event.target;

                    // Event delegate
                    if (target &&
                        typeof target !== 'undefined' &&
                        target.tagName === 'svg' ||
                        target.tagName === 'path'
                    ) {
                        primaryMenu.classList.remove('is-active');
                        bodyElement.style.overflow = 'visible';
                    }
                }, false);

                this.openButton.addEventListener('click', function(event) {
                    const target = event.target;

                    // Event delegate
                    if (target &&
                        typeof target !== 'undefined' &&
                        target.tagName === 'svg' ||
                        target.tagName === 'path'
                    ) {
                        primaryMenu.classList.add('is-active');
                        bodyElement.style.overflow = 'hidden';
                    }
                }, false);
            },

            /**
             * @author Keith Murphy | nomadmystics@gmail.com
             * @description Add icons to the top level of the mobile nav
             *
             * @return void
             */
            addFontAwesomeIcons() {
                const self = this;

                // DOM Elements
                const topLevelNavItems = window.document.querySelectorAll('#nav-primary-menu-container .nav-primary-menu > .menu-item-has-children > a');
                const topLevelNavItemsLength = topLevelNavItems.length;

                if (!topLevelNavItems) {
                    return;
                }

                for (let item = 0; item < topLevelNavItemsLength; item++) {
                    if (topLevelNavItems[item] && typeof topLevelNavItems[item] !== 'undefined') {
                        // Recreate the anchor and inject it in the sub-menu
                        let textContent = topLevelNavItems[item].textContent;
                        let link = topLevelNavItems[item].href;

                        topLevelNavItems[item].nextElementSibling.insertAdjacentHTML('afterbegin', `<a href="${link}">${textContent}</a>`);

                        // Create events
                        topLevelNavItems[item].addEventListener('click', function(event) {
                            self.toggleMenuItem(event);
                        }, false);

                    }
                }
            },

            /**
             * @author Keith Murphy | nomadmystics@gmail.com
             * @description Toggle the sub-menus on click
             *
             * @param {object} event
             * @return void
             */
            toggleMenuItem(event) {
                event.preventDefault();
                const target = event.target;

                if (target && target.tagName === 'A') {

                    // Set our active states
                    target.classList.toggle('is-active');

                    if (target.nextElementSibling.classList.contains('sub-menu')) {
                        target.nextElementSibling.classList.toggle('is-active');
                    }

                }
            },
        },
        mounted() {
            const self = this;

            window.addEventListener('DOMContentLoaded', function() {
                self.closeButton = window.document.getElementById('js-off-canvas-close-span');
                self.openButton = window.document.getElementById('js-off-canvas-open-span');


                self.toggleMenu();
                self.addFontAwesomeIcons();
            });
        },
    };
</script>
