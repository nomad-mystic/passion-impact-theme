<template>
    <div class="posts-component">
        <div v-if="postsLength > 0" class="posts__content cards__content">
            <div v-if="isPositionsLoaded && commentIndex <= postsToShow && postsLength > 0"
                 v-for="commentIndex in postsToShow"
                 class="posts__card cards__card">

                <div class="posts__card-above cards__card-above">
                    <div class="posts__card-image cards__card-image" :style="`background-image: url(${setPostImage(postsFinal[commentIndex - 1])});`"></div>
                    <div class="posts__card-date cards__card-date"><p>{{ formatDate(postsFinal[commentIndex - 1].date) }}</p></div>
                    <div class="posts__card-description cards__card-description"><p>{{ postsFinal[commentIndex - 1].excerpt.rendered.replace(/(<([^>]+)>)/gi, "") }}</p></div>
                </div>
                <div class="posts__card-below cards__card-below">
                    <h3 class="posts__card-title cards__card-title" v-html="postsFinal[commentIndex - 1].title.rendered"></h3>
                    <div class="posts__card-link cards__card-link hollow-button">
                        <a v-bind:href="`${postsFinal[commentIndex - 1].link}`" class="link">Read More</a>
                    </div>
                </div><!-- End posts__card-below -->
            </div><!-- End posts__card -->
        </div><!-- End posts__content -->

        <div id="posts__pagination" class="posts__pagination cards__pagination cards__isInvisible">
            <h3 id="posts__load-more" class="posts__load-more cards__load-more hollow-button" @click="postsToShow += offset">Load More</h3>
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
        eventsUtils__formatDate,
    } from '../utils/events-utils';

    export default {
        name: 'post-cards',
        props: {
            fetchURL: {
                default: '',
                type: String,
            },
            emptyImage: {
              default: '',
              type: String,
            },
        },
        data() {
            return {
                posts: {},
                postsFinal: {},
                postsResults: {},
                numberOfPositions: 0,
                offset: 9,
                isLoading: true,
                isPositionsLoaded: false,
                postsIndex: 0,
                postsToShow: 9,
                postsLength: 0,
                numberOfVisiblePositions: 9,
            };
        },
        methods: {
            /**
             * @description Set the featured image of the card. If the featured image is empty use the default one.
             * @author Keith Murphy | nomadmystics@gmail.com
             *
             * @return {string}
             */
            setPostImage(post) {

                if (post && post._embedded['wp:featuredmedia'] && typeof post._embedded['wp:featuredmedia'] !== 'undefined') {
                    const postImageLength = post._embedded['wp:featuredmedia'].length;

                    if (postImageLength && postImageLength === 1) {
                        const postImage = post._embedded['wp:featuredmedia'][0]['source_url'];

                        if (postImage && typeof postImage !== 'undefined') {

                            return postImage;
                        }
                    }
                } else {
                    return `${this.emptyImage}`;
                }
            },

            /**
             * @inheritDoc
             */
            formatDate(date) {
                return eventsUtils__formatDate(date);
            },

            /**
             * @author Keith Murphy | nomadmystics@gmail.com
             *
             * @return Promise<array>
             */
            async getPosts() {
                const self = this;

                // Set up our loader
                this.isLoading = true;

                // Call the events API
                const posts = fetch(this.fetchURL)
                    .then((data) => {

                        return data.json();

                    })
                    .then((posts) => {

                        // console.log(posts);

                        // Gather the events array length
                        self.postsLength = posts.length;

                        // The length of the total events is less than 9 show all events
                        if (self.postsLength < self.postsToShow) {
                            self.postsToShow = self.postsLength;
                        }

                        // Stop our spinner
                        self.isLoading = false;

                        return posts;
                    })
                    .catch(err => console.error(err));

                return posts;
            },

            /**
             * @returns {Promise<void>}
             */
            async waitIsEventsLoaded (posts) {
                // Prevent offset issue
                if (posts.length < this.postsToShow) {
                    this.postsToShow = posts.length;
                }

                // Show our elements
                const paginationElement = window.document.getElementById('posts__pagination');
                paginationElement.classList.remove('cards__isInvisible');

                this.isPositionsLoaded = true;

            },

            /**
             * @description When there are no more events disable load more button.
             * @author Keith Murphy | nomadmystics@gmail.com
             *
             * @param {object} event
             * @return {null|string}
             */
            disableLoadMoreClick(event) {
                if ((this.numberOfPositions - this.postsToShow) === 0) {

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
                const loadMoreElement = window.document.getElementById(`posts__load-more`);

                if (this.postsLength > 9) {
                    // There are less than 9 events update the pagination
                    if ((self.numberOfPositions - self.postsToShow) < 9) {

                        self.offset = self.numberOfPositions - self.postsToShow;

                    }

                    loadMoreElement.addEventListener('click', function(event) {
                        // There are less than 9 events update the pagination
                        if ((self.numberOfPositions - self.postsToShow) < 9) {

                            self.offset = self.numberOfPositions - self.postsToShow;

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
                this.posts = await this.getPosts().catch(err => console.error(err));

                if (this.posts) {
                    this.postsFinal = this.posts;

                    if (this.postsFinal && typeof this.postsFinal !== 'undefined') {

                        // Grab the total number of event for pagination
                        this.numberOfPositions = this.postsFinal.length;
                        this.postsLength = this.postsFinal.length;

                        await this.waitIsEventsLoaded(this.postsFinal).catch(err => console.error(err));

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
