<template>
    <div class="modal">
        <slot/>
    </div>
</template>

<script>
    export default {
        name: 'modal',
        props: {
            activateElement: {
                type: String,
                default: '',
            },
            modalContentParent: {
                type: String,
                default: '',
            }
        },
        data() {
            return {
                modalElement: '',
            };
        },
        methods: {
            /**
             * @description Open the modal
             * @author Keith Murphy | nomadmystics@gmail.com
             * Shamelessly taken from https://www.w3schools.com/howto/howto_css_modals.asp
             *
             * @return void
             */
            openModal(event = null, bodyElement = null) {
                event.preventDefault();

                this.modalElement.style.display = 'block';
                bodyElement.classList.add('noScroll');

            },

            /**
             * @description Close the modal
             * @author Keith Murphy | nomadmystics@gmail.com
             * Shamelessly taken from https://www.w3schools.com/howto/howto_css_modals.asp
             *
             * @return void
             */
            closeModal(bodyElement = null) {

                this.modalElement.style.display = 'none';
                bodyElement.classList.remove('noScroll');
            },
            handleModalState() {
                const self = this;

                const clickElement = window.document.getElementById(`${self.activateElement}`);
                self.modalElement = window.document.getElementById(`${self.modalContentParent}`);
                const closeElement = window.document.querySelector(`.${self.modalContentParent} .close`);

                const bodyElement = window.document.body;

                // Open our modal
                clickElement.addEventListener('click', function(event) {
                    self.openModal(event, bodyElement);
                });

                // Close our modal
                closeElement.addEventListener('click', function() {
                    self.closeModal(bodyElement);
                });

                window.addEventListener('click', function(event) {

                    if (event.target === self.modalElement) {

                        self.modalElement.style.display = 'none';
                        bodyElement.classList.remove('noScroll');
                    }

                }, false);
            }
        },
        mounted() {
            const self = this;

            window.addEventListener('DOMContentLoaded', function() {
                self.handleModalState();
            });

        }
    }
</script>
