<template>
    <div class="positions-component">
        <div v-if="positionsLength > 0" class="positions__content cards__content">
            <div v-if="isPositionsLoaded && commentIndex <= positionsToShow && positionsLength > 0"
                 v-for="commentIndex in positionsToShow"
                 class="positions__card cards__card"
                 v-bind:class="[hasEndedAddClass(positionsFinal[commentIndex - 1].end_date_time, positionsFinal[commentIndex - 1])]">

                <div class="positions__card-above cards__card-above">
                    <div class="positions__card-image cards__card-image" :style="`background-image: url(${positionsFinal[commentIndex - 1].image});`"></div>
                    <div class="positions__card-date cards__card-date"><p>{{ formatDate(positionsFinal[commentIndex - 1].start_date_time) }}</p></div>
                    <div class="positions__card-valid cards__card-valid" v-html="hasEnded(positionsFinal[commentIndex - 1].end_date_time, positionsFinal[commentIndex - 1])"></div>
                    <!-- @todo Figure out if this could be used in the UI -->
                    <!-- <div class="positions__card-description cards__card-description"><p>{{ positionsFinal[commentIndex - 1].description.replace(/(<([^>]+)>)/gi, "") }}</p></div>-->
                </div>
                <div class="positions__card-below cards__card-below">
                    <h3 class="positions__card-title cards__card-title">{{ positionsFinal[commentIndex - 1].title }}</h3>
                    <div class="positions__card-link cards__card-link hollow-button">
                        <a v-bind:href="`https://www.givepulse.com/event/${positionsFinal[commentIndex - 1].id}`" target="_blank" class="link">Read More</a>
                    </div>
                </div><!-- End positions__card-below -->
            </div><!-- End positions__card -->
        </div><!-- End positions__content -->

        <div id="positions__pagination" class="positions__pagination cards__pagination positions__isInvisible">
            <h3 id="positions__load-more" class="positions__load-more cards__load-more hollow-button" @click="positionsToShow += offset">Load More</h3>
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
    } from '../utils/events-utils';

    export default {
        name: 'positions',
        props: {
          fetchURL: {
              default: '',
              type: String,
          },
        },
        data() {
            return {
                positions: {},
                positionsFinal: {},
                positionsResults: {},
                numberOfPositions: 0,
                offset: 9,
                isLoading: true,
                isPositionsLoaded: false,
                positionsIndex: 0,
                positionsToShow: 9,
                positionsLength: 0,
                numberOfVisiblePositions: 9,
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
             * {@inheritDoc}
             */
            hasEndedAddClass(endDate, event) {
                return eventsUtils__hasEndedAddClass(endDate, event);
            },

            /**
             * @author Keith Murphy | nomadmystics@gmail.com
             * @description
             * @example http://passionimpact.org.test/wp-json/passion-impact/v1/events/positions
             *
             * @return Promise<array>
             */
            async getPositions() {
                const self = this;

                // Set up our loader
                this.isLoading = true;

                // Call the events API
                const positions = fetch(this.fetchURL)
                    .then((data) => {

                        return data.json();

                    })
                    .then((positions) => {
                        // Gather the events array length
                        self.positionsLength = positions.results.length;

                        // The length of the total events is less than 9 show all events
                        if (self.positionsLength < self.positionsToShow) {
                            self.positionsToShow = self.positionsLength;
                        }

                        // Stop our spinner
                        self.isLoading = false;

                        return positions.results;
                    })
                    .catch(err => console.error(err));

                return positions;
            },

            /**
             *
             * @returns {Promise<void>}
             */
            async waitIsEventsLoaded (positions) {
                // Prevent offset issue
                if (positions.length < this.positionsToShow) {
                    this.positionsToShow = positions.length;
                }

                // Show our elements
                const paginationElement = window.document.getElementById('positions__pagination');
                paginationElement.classList.remove('positions__isInvisible');

                this.isPositionsLoaded = true;
            },

            /**
             * @author Keith Murphy | nomadmystics@gmail.com
             * @description When there are no more events disable load more button.
             *
             * @param {object} event
             * @return {null|string}
             */
            disableLoadMoreClick(event) {
                if ((this.numberOfPositions - this.positionsToShow) === 0) {

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
            loadMore() {
                const self = this;

                // Setup our load more functionality
                const loadMoreElement = window.document.getElementById(`positions__load-more`);

                if (this.positionsLength > 9) {
                    // There are less than 9 events update the pagination
                    if ((self.numberOfPositions - self.positionsToShow) < 9) {

                        self.offset = self.numberOfPositions - self.positionsToShow;

                    }

                    loadMoreElement.addEventListener('click', function(event) {
                        // There are less than 9 events update the pagination
                        if ((self.numberOfPositions - self.positionsToShow) < 9) {

                            self.offset = self.numberOfPositions - self.positionsToShow;

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
                // Set up our initial load
                this.positions = await this.getPositions().catch(err => console.error(err));

                if (this.positions) {
                    // Filter our events
                    this.positions = await eventsUtils__filterNonePublished(this.positions).catch(err => console.error(err));

                    // Sort events by date
                    this.positionsFinal = await eventsUtils__sortEvents(this.positions).catch(err => console.error(err));

                    if (this.positionsFinal && typeof this.positionsFinal !== 'undefined') {

                        // Grab the total number of event for pagination
                        this.numberOfPositions = this.positionsFinal.length;
                        this.positionsLength = this.positionsFinal.length;

                        await this.waitIsEventsLoaded(this.positionsFinal).catch(err => console.error(err));

                        // Our click events
                        this.loadMore();
                    }
                }
            } catch (e) {
                console.error(e);
            }
        },
    };
</script>
