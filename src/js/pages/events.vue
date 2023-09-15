<template>
    <div class="events-component">
        <div v-if="eventsLength > 0" class="events__content cards__content" :data-event-type="title">
            <div v-if="isEventsLoaded && commentIndex <= eventsToShow && eventsLength > 0"
                 v-for="commentIndex in eventsToShow"
                 class="events__card cards__card"
                 v-bind:class="[hasEndedAddClass(events[commentIndex - 1].end_date_time, events[commentIndex - 1])]">

                <div class="events__card-above cards__card-above">
                    <div class="events__card-image cards__card-image" :style="`background-image: url(${events[commentIndex - 1].image});`"></div>
                    <div class="events__card-date cards__card-date"><p>{{ formatDate(events[commentIndex - 1].start_date_time) }}</p></div>
                    <div class="events__card-valid cards__card-valid" v-html="hasEnded(events[commentIndex - 1].end_date_time, events[commentIndex - 1])"></div>
                </div><!-- End events__card-above  -->

                <div class="events__card-below cards__card-below">
                    <h3 class="events__card-title cards__card-title">{{ events[commentIndex - 1].title }}</h3>
                    <div class="events__card-link cards__card-link hollow-button">
                        <a v-bind:href="`https://www.givepulse.com/event/${events[commentIndex - 1].id}`" target="_blank" class="link">Read More</a>
                    </div>
                </div><!-- End events__card-below -->
            </div><!-- End events__card -->
        </div><!-- End events__content -->

        <div class="events__pagination cards__pagination events__isInvisible">
            <h3 :id="`events__load-more-${this.id}`" class="events__load-more cards__load-more hollow-button" @click="eventsToShow += offset">Load More</h3>
        </div>

        <div class="spinner" :class="{'is-visible': this.isLoading}">
            <svg class="spinner-svg" width="65px" height="65px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg">
                <circle class="path" fill="none" stroke-width="6" stroke-linecap="round" cx="33" cy="33" r="30"></circle>
            </svg>
        </div>

    </div>
</template>

<script>
    import {
        eventsUtils__hasEnded,
        eventsUtils__hasEndedAddClass,
        eventsUtils__formatDate,
        eventsUtils__sortEvents,
        eventsUtils__filterNonePublished,
        eventsUtils__removePositions,
    } from '../utils/events-utils';

    export default {
        name: 'events',
        props: {
            id: {
                default: 169540,
                type: Number,
            },
            title: {
                default: '',
                type: String,
            },
            index: {
                default: '0',
                type: String,
            },
        },
        data() {
            return {
                events: {},
                eventsFinal: {},
                eventResults: {},
                numberOfEvents: 0,
                offset: 9,
                isLoading: true,
                isEventsLoaded: false,
                eventsIndex: 0,
                eventsToShow: 9,
                eventsLength: 0,
                numberOfVisibleEvents: 9,
            };
        },
        methods: {
            /**
             * @inheritDoc
             */
            formatDate(date) {
                return eventsUtils__formatDate(date);
            },

            /**
             * @inheritDoc
             */
            hasEnded(endDate, event) {
                return eventsUtils__hasEnded(endDate, event);
            },

            /**
             * @inheritDoc
             */
            hasEndedAddClass(endDate, event) {
                return eventsUtils__hasEndedAddClass(endDate, event);
            },

            /**
             * @author Keith Murphy | nomadmystics@gmail.com
             * @description Check and update the local property if the events are loaded
             *
             * @return Promise
             */
            async waitIsEventsLoaded(events) {
                // Prevent offset issue
                if (events.length < this.eventsToShow) {
                    this.eventsToShow = events.length;
                }

                this.isEventsLoaded = true;
            },

            /**
             * @author Keith Murphy | nomadmystics@gmail.com
             * @description Call the events API
             *
             * @returns {Promise<array>}
             */
            async getEvents() {
                const self = this;

                // Set up our loader
                this.isLoading = true;

                // Call the events API
                const events = fetch(`/wp-json/passion-impact/v1/events/group/?id=${this.id}`)
                    .then((data) => {

                        return data.json();

                    })
                    .then((events) => {
                        // Gather the events array length
                        self.eventsLength = events.length;

                        // The length of the total events is less than 9 show all events
                        if (self.eventsLength < self.eventsToShow) {
                            self.eventsToShow = self.eventsLength;
                        }

                        // Stop our spinner
                        self.isLoading = false;

                        return events;
                    })
                    .catch(err => console.log(err));

                return events;
            },

            /**
             * @description When there are no more events disable load more button.
             * @author Keith Murphy | nomadmystics@gmail.com
             *
             * @param {object} event
             * @return {null|string}
             */
            disableLoadMoreClick(event) {
                if ((this.numberOfEvents - this.eventsToShow) === 0) {

                    return 'disable';

                } else {

                    return null;

                }
            },

            /**
             * @description Add our load more functionality
             * @author Keith Murphy | nomadmystics@gmail.com
             *
             * @return void
             */
            loadMoreEvent() {
                const self = this;

                // Setup our load more functionality
                const loadMoreElement = window.document.getElementById(`events__load-more-${this.id}`);

                if (this.eventsLength > 9) {
                    loadMoreElement.addEventListener('click', function(event) {
                        // There are less than 9 events update the pagination
                        if ((self.numberOfEvents - self.eventsToShow) < 9) {

                            self.offset = self.numberOfEvents - self.eventsToShow;

                        }

                        let shouldDisable = self.disableLoadMoreClick(event);

                        // Check if we should disable the button
                        if (shouldDisable && shouldDisable === 'disable') {
                            this.classList.add('light-button--disable');

                            this.parentElement.style.cursor = 'not-allowed';
                        }

                    }, false);

                } else {
                    loadMoreElement.classList.add('light-button--disable');

                    loadMoreElement.parentElement.style.cursor = 'not-allowed';
                }
            }
        },
        async mounted() {
            try {
                // Setup our initial load
                this.events = await this.getEvents().catch(err => console.error(err));

                if (this.events && this.events.length > 0) {

                    // // Filter our events
                    this.events = await eventsUtils__filterNonePublished(this.events).catch(err => console.error(err));

                    this.events = await eventsUtils__removePositions(this.events).catch(err => console.log(err));

                    // Sort events by date
                    this.eventsFinal = await eventsUtils__sortEvents(this.events).catch(err => console.error(err));

                    if (this.eventsFinal && typeof this.eventsFinal !== 'undefined') {

                        await this.waitIsEventsLoaded(this.eventsFinal).catch(err => console.error(err));

                        // Grab the total number of event for pagination
                        this.numberOfEvents = this.eventsFinal.length;

                        // Our click events
                        this.loadMoreEvent();

                        // Activate the first tab

                        // console.log(this.index);

                        if (this.index && this.index === '0') {
                            const firstChildHeader = window.document.querySelector('.events__header-navigation .events__title-container .events__nav-title');

                            if (firstChildHeader && typeof firstChildHeader !== 'undefined') {
                                // @todo This is a hotfix, this is a race condition with when the index is defined.
                                // Not sure if it has to do with the PHP template or with this Vue component.
                                // I suspect this component

                                setTimeout(() => {
                                    firstChildHeader.click();
                                }, 1000);
                            }
                        }
                    }
                }
            } catch (e) {
                console.error(e);
            }
        },
    };
</script>
