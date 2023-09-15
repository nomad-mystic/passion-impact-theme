/**
 * @description Build the dynamic functionality we need for the Event ACF options page.
 * @author Keith Murphy | nomadmystics@gmail.com
 *
 * @return {{init: init}}
 */
const eventsACFPage = (() => {
    /**
     * @author Keith Murphy | nomadmystics@gmail.com
     * @description Start our functionality here
     *
     * @return void
     */
    const init = () => {
        window.addEventListener('DOMContentLoaded', () => {
            events_getOurGroupInfo();
        });
    };

    /**
     * @description Call our API endpoint so we can display the IDs of the PI groups.
     * @author Keith Murphy | nomadmystics@gmail.com
     *
     * @return void
     */
    const events_getOurGroupInfo = () => {
        fetch('/wp-json/passion-impact/v1/group')
        .then((res) => {
            return res.json();
        })
        .then((groupInfo) => {

            if (groupInfo) {
                events_buildEventInfo(groupInfo);
            }

            return {};

        })
        .catch(err => console.error(err));

    };

    /**
     * @description Build the DOM
     * @author Keith Murphy | nomadmystics@gmail.com
     *
     * @param {object} groupInfo
     * @return void
     */
    const events_buildEventInfo = (groupInfo) => {
        // Grab what we need
        const eventsSettings = window.document.querySelector('#events-settings .description');
        const results = groupInfo.results;
        const resultsLength = results.length;

        // Build the DOM content
        let content = `<ul>`;

        for (let result = 0; result < resultsLength; result++) {
            if (results[result] && typeof results[result] !== 'undefined') {
                content += `<li style="margin-bottom: 0;">${results[result].title} = ${results[result].id}</li>`
            }
        }

        content += `</ul>`;

        // Append to DOM
        eventsSettings.innerHTML = content;
    };

    return {
        init,
    }
})();

export default eventsACFPage;
