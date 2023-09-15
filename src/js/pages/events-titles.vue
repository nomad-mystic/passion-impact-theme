<template>
    <div class="events__title-container">
        <h3 :id="`events__nav-title-${this.id}`" class="events__nav-title page-paragraph">{{ title }}</h3>
    </div>
</template>

<script>
    import {tabs__createTabEvents} from "../utils/tabs";

    export default {
        name: 'events-titles',
        props: {
            title: {
                default: '',
                type: String,
            },
            id: {
                default: '',
                type: String,
            },
        },
        methods: {
            /**
             * @author Keith Murphy | nomadmystics@gmail.com
             * @description Grab our titles and add events to them, so the can be tabs
             *
             * @return void
             */
            tabsVisibility() {
                const titleElement = window.document.getElementById(`events__nav-title-${this.id}`);

                tabs__createTabEvents(titleElement);

            },
        },
        mounted() {

            window.addEventListener('DOMContentLoaded', this.tabsVisibility);

        }
    };
</script>
