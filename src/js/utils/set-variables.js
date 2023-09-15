/**
 * @description This will set the value for the grid columns depending on the number of ACF members.
 * @author Keith Murphy | nomadmystics@gmail.com
 *
 * @return void
 */
const setBoardGridSize = () => {

    window.addEventListener('DOMContentLoaded', function() {
        const boardImages = window.document.querySelector('.home-board-committees .board-images');
        const numberOfMembers = window.document.querySelector('.home-board-committees .home-number-of-members');

        if (numberOfMembers && typeof numberOfMembers !== 'undefined') {
            const number = numberOfMembers.dataset.numberOfMembers;

            boardImages.style.setProperty('--number-of-members', number);
        }
    });

};

export {
    setBoardGridSize,
}

