/**
 * @description On click toggle the visibility of the events tab content
 * @author Keith Murphy | nomadmystics@gmail.com
 *
 * @param {object} event
 * @return void
 */
const tabs__tabsVisibility = (event) => {
    // DOM Elements
    let tabcontent = window.document.getElementsByClassName("events__content");
    let pagination = window.document.getElementsByClassName('events__pagination');
    let tabTitles = window.document.getElementsByClassName("events__nav-title");

    for (let i = 0; i < tabcontent.length; i++) {
        if (tabcontent[i]) {

            if (event && event.target && tabcontent[i].dataset.eventType === event.target.textContent) {

                tabcontent[i].classList.remove('events__isInvisible');

                if (pagination[i]) {
                    pagination[i].classList.remove('events__isInvisible');
                }

                if (tabTitles[i]) {
                    tabTitles[i].classList.add('events__nav-title--active');
                }

            } else {

                tabcontent[i].classList.add('events__isInvisible');

                if (pagination[i]) {
                    pagination[i].classList.add('events__isInvisible');
                }

                if (tabTitles[i]) {
                    tabTitles[i].classList.remove('events__nav-title--active');
                }
            }
        }
    }
};

/**
 * @description Pass in a element that you want the Tab title event
 * @author Keith Murphy | nomadmystics@gmail.com
 * @link https://www.w3schools.com/howto/howto_js_tabs.asp
 *
 * @param {object} element
 * @return void
 */
const tabs__createTabEvents = (element) => {
    element.addEventListener('click', (event) => {
        tabs__tabsVisibility(event);
    });
};

export {
    tabs__tabsVisibility,
    tabs__createTabEvents,
}
