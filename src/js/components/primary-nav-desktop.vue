<template>
    <div class="primary-nav-component">
        <slot />
    </div>
</template>

<script>
    export default {
        name: 'primary-nav-desktop',
        data() {
            return {};
        },
        methods: {
            /**
             * @author Keith Murphy | nomadmystics@gmail.com
             * @description Toggle the desktops nav's visibility
             *
             * @return void
             */
            toggleMenu() {
                const primaryMenuSubMenus = window.document.querySelectorAll('.header__large-nav .menu-item-has-children .sub-menu');
                // For each of the menus with children
                for (let item = 0; item < primaryMenuSubMenus.length; item++) {
                    if (primaryMenuSubMenus[item] && typeof primaryMenuSubMenus[item] !== 'undefined') {
                        // Create our events
                        primaryMenuSubMenus[item].addEventListener('mouseover', function(event) {
                            const target = event.target;

                            if (target && target.tagName === 'A') {
                                const closestParentFirstLevel = target.closest('li.menu-item-has-children.is-not-active');
                                const closestParentSecondLevel = target.closest('.header__large-nav .nav-primary-menu .menu-item-has-children .menu-item-has-children');

                                if (closestParentFirstLevel) {
                                    closestParentFirstLevel.classList.add('is-active');

                                    console.dir(target);
                                    console.dir(closestParentFirstLevel);
                                }
                            }

                        }, false);

                        // Create our events
                        primaryMenuSubMenus[item].addEventListener('mouseout', function(event) {
                            const target = event.target;

                            if (target && target.tagName === 'A') {
                                const closestParent = target.closest('.menu-item-has-children');

                                closestParent.classList.remove('is-active');
                            }

                        }, false);
                    }
                }
            },

            /**
             * @author Keith Murphy | nomadmystics@gmail.com
             *
             * @return void
             */
            stopEventForNoneActive() {
                const notActiveNavItems = window.document.querySelectorAll('.is-not-active > a');
                const notActiveNavItemsLength = notActiveNavItems.length;

                for (let item = 0; item < notActiveNavItemsLength; item++) {
                    // Sanity check
                    if (notActiveNavItems[item] && typeof notActiveNavItems[item] !== 'undefined') {

                        // Prevent users from click the not-active link
                        notActiveNavItems[item].addEventListener('click', function(event) {
                            event.preventDefault();
                        }, false);
                    }
                }
            },
        },
        mounted() {
            const self = this;

            window.addEventListener('DOMContentLoaded', function() {
                self.stopEventForNoneActive();

                self.toggleMenu();

            });
        },
    };
</script>
