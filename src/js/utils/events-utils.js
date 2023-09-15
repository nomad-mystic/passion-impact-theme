/**
 * @description Make the card innerHTML with class attached
 * @author Keith Murphy | nomadmystics@gmail.com
 *
 * @param {string} endDate
 * @param {object} event
 * @return {string}
 */
const eventsUtils__hasEnded = (endDate, event) => {

    if (endDate && typeof endDate !== 'undefined' && event && typeof event !== 'undefined' ) {
        let formattedDate = new Date(endDate).toISOString();
        let now = new Date().toISOString();

        if (event.cancelled && event.cancelled === 'yes') {
            return `<p class="cards__card-valid-cancelled">Cancelled</p>`;
        }

        if (now > formattedDate) {
            return `<p class="cards__card-valid-ended">Event has Ended</p>`;
        } else {
            return `<p class="cards__card-valid-on-going">On Going</p>`;
        }
    }

};

/**
 * @description This is for adding classes to an element depending on is the event is ended or still going on.
 * @author Keith Murphy | nomadmystics@gmail.com
 *
 * @param {string} endDate
 * @param {object} event
 * @return {string}
 */
const eventsUtils__hasEndedAddClass = (endDate, event) => {

    if (endDate && typeof endDate !== 'undefined' && event && typeof event !== 'undefined' ) {
        let formattedDate = new Date(endDate).toISOString();
        let now = new Date().toISOString();

        if (event.cancelled && event.cancelled === 'yes') {
            return 'cards__card-cancelled';
        }

        if (now > formattedDate) {
            return 'cards__card-ended';
        } else {
            return 'cards__card-on-going';
        }
    }
};

/**
 * @description Format our dates for the end user
 * @author Keith Murphy | nomadmystics@gmail.com
 *
 * @param {string} date
 * @return {string} formattedDate
 */
const eventsUtils__formatDate = (date) => {

    if (date && typeof date !== 'undefined') {
        let formattedDate = new Date(date).toUTCString();
        formattedDate = formattedDate.split(' ').slice(0, 4).join(' ');

        if (formattedDate === 'Invalid Date') {
            formattedDate = 'No Available';
        }

        return formattedDate;
    }

};

/**
 * @description Sort our events by date
 * @author Keith Murphy | nomadmystics@gmail.com
 *
 * @param {object} events
 * @return Promise
 */
const eventsUtils__sortEvents = async (events) => {
    return new Promise((resolve, reject) => {

        const sortedEvents = events.sort((a, b) => new Date(b.start_date_time) - new Date(a.start_date_time));

        resolve(sortedEvents);

    });
};

/**
 * @description Filter out event that aren't published
 * @author Keith Murphy | nomadmystics@gmail.com
 *
 * @param {array} events
 * @return Promise
 */
const eventsUtils__filterNonePublished = async (events) => {
    return new Promise((resolve, reject) => {
        let filteredEvents =  events.filter((event) => {

            if (event && typeof event !== 'undefined' && event.is_published === 'yes') {
                return event;
            }

        });

        resolve(filteredEvents);
    });
};

/**
 * @description This will remove events with Positions if it has tag
 * @author Keith Murphy | nomadmystics@gmail.com
 *
 * @param {array} events
 * @returns {Promise<unknown>}
 */
const eventsUtils__removePositions = async (events) => {
    return new Promise((resolve, reject) => {
        const nonPositions = events.filter((event) => {
            if (event.tags) {

                return !event.tags.includes('Positions');

            }
        });

        resolve(nonPositions);
    });
};

export {
    eventsUtils__hasEnded,
    eventsUtils__hasEndedAddClass,
    eventsUtils__formatDate,
    eventsUtils__sortEvents,
    eventsUtils__filterNonePublished,
    eventsUtils__removePositions,
};
