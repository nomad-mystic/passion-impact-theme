<template>
    <div class="home-board-committees">
        <slot />
    </div>
</template>

<script>
    export default {
        name: 'home-board-committees',
        methods: {
            /**
             * @description create the function to add and remove active class from panels
             *
             * @param {object} event
             * @param {Element} boardPanel
             * @param {Element} committeesPanel
             * @param {array} controlPanelsArray
             * @param {number} controlPanelsArrayLength
             * @return void
             */
            addRemoveInvisibilityBoardCommittees(event, boardPanel, committeesPanel, controlPanelsArray, controlPanelsArrayLength) {
                // Add and/or keep current state of element
                if (event.target && 'P' === event.target.tagName && !event.currentTarget.classList.contains('is-panel-active')) {
                    // Remove the active class for adding later to another element
                    for (let panel = 0; panel < controlPanelsArrayLength; panel++) {
                        controlPanelsArray[panel].classList.remove('is-panel-active');
                    }

                    event.target.classList.toggle('is-panel-active');

                    // Change the state of the current plain to be seen or not
                    if ('js-board-panel-control' === event.target.id) {
                        // boardPanel.style.transition = 'all .5s ease-in-out';
                        // committeesPanel.style.transition = 'all .5s ease-in-out';

                        boardPanel.classList.remove('is-invisible');
                        committeesPanel.classList.add('is-invisible');
                    } else if ('js-committees-panel-control' === event.target.id) {
                        // boardPanel.style.transition = 'all .5s ease-in-out';
                        // committeesPanel.style.transition = 'all .5s ease-in-out';

                        committeesPanel.classList.remove('is-invisible');
                        boardPanel.classList.add('is-invisible');
                    }
                }
            },

            /**
             * @description This will show and hide the board members based on the image they click
             *
             * @param {object} event
             * @param {array} boardDetailsArray
             * @param {number} boardDetailsArrayLength
             * @param {array} boardImagesArray
             * @param {number} boardImagesArrayLength
             * @return void
             */
            addRemoveInvisibilityBoardMember(event, boardDetailsArray, boardDetailsArrayLength, boardImagesArray, boardImagesArrayLength) {
                console.log(event.target);
                if (event.target && 'DIV' === event.target.tagName) {
                    // GEt everything after the last "-" in id
                    let boardMemberNumber = event.target.id.split('-').pop();

                    // Remove the active class for adding later to another element
                    for (let panel = 0; panel < boardImagesArrayLength; panel++) {
                        boardImagesArray[panel].classList.remove('is-active-member-image');
                    }

                    // Give the image the active style
                    event.target.classList.toggle('is-active-member-image');

                    // Based on the member image clicked show or hide member details
                    for (let member = 0; member < boardDetailsArrayLength; member++) {
                        if (boardDetailsArray[member].classList.contains(`js-board-detail-${boardMemberNumber}`)) {

                            boardDetailsArray[member].classList.remove('is-invisible');

                        } else {

                            boardDetailsArray[member].classList.add('is-invisible');

                        }
                    }
                }
            },
            initialBoardState() {
                const self = this;
                //DOM Elements
                // These are needed to control the board and committees plains
                const controlPanels = window.document.querySelectorAll('.control');
                const controlPanelsArray = Array.from(controlPanels);
                const controlPanelsArrayLength = controlPanelsArray.length;
                const boardPanel = window.document.getElementById('js-board-panel');
                const committeesPanel = window.document.getElementById('js-committees-panel');

                // These are needed for display the visibility of the board members
                const boardImages = window.document.querySelectorAll('.js-board-image');
                const boardImagesArray = Array.from(boardImages);
                const boardImagesArrayLength = boardImagesArray.length;
                const boardDetails = window.document.querySelectorAll('.js-board-detail');
                const boardDetailsArray = Array.from(boardDetails);
                const boardDetailsArrayLength = boardDetailsArray.length;

                // Add events for the plains
                for (let panel = 0; panel < controlPanelsArrayLength; panel++) {
                    controlPanelsArray[panel].addEventListener('click', function(event) {
                        self.addRemoveInvisibilityBoardCommittees(event, boardPanel, committeesPanel, controlPanelsArray, controlPanelsArrayLength);
                    }, false);
                }

                for (let image = 0; image < boardImagesArrayLength; image++) {
                    // Add active class to first image
                    if (boardImagesArray[0]) {
                        boardImagesArray[0].classList.add('is-active-member-image');
                    }

                    if (boardDetailsArray[0]) {
                        boardDetailsArray[0].classList.remove('is-invisible');
                    }

                    // Add events to each of the images
                    boardImagesArray[image].addEventListener('click', function(event) {
                        self.addRemoveInvisibilityBoardMember(event, boardDetailsArray, boardDetailsArrayLength, boardImagesArray, boardImagesArrayLength);
                    }, false);
                }
            },
        },
        mounted() {
            this.initialBoardState()
        },
    };
</script>
