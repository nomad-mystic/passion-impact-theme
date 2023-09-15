import Vue from 'vue';

// Functions
import {
    setBoardGridSize,
} from './utils/set-variables';

setBoardGridSize();

// Font Awesome
import { FontAwesomeIcon } from './vendor/font-awesome-load';

// Components
import FooterContact from './components/footer-contact.vue';
import HomeBoardCommittees from './components/home-board-committees.vue';
import DonateForm from './components/donate-form.vue';
import LGLForm from './components/lgl-form.vue';
import Accordion from './components/accordion.vue';
import Modal from './components/modal.vue';
import Slider from './components/slider.vue';
import PrimaryNavDesktop from './components/primary-nav-desktop.vue';
import PrimaryNavMobile from './components/primary-nav-mobile.vue';
import GoogleMap from './components/google-map.vue';
import PostCards from './components/post-cards.vue';

// Pages
import Blog from './pages/blog.vue';
import Events from './pages/events.vue';
import EventsTitles from './pages/events-titles.vue';
import Positions from './pages/positions.vue';

Vue.component(FooterContact.name, FooterContact);
Vue.component(HomeBoardCommittees.name, HomeBoardCommittees);
Vue.component(DonateForm.name, DonateForm);
Vue.component(LGLForm.name, LGLForm);
Vue.component(Accordion.name, Accordion);
Vue.component(Modal.name, Modal);
Vue.component(Slider.name, Slider);
Vue.component(PrimaryNavDesktop.name, PrimaryNavDesktop);
Vue.component(PrimaryNavMobile.name, PrimaryNavMobile);
Vue.component(GoogleMap.name, GoogleMap);
Vue.component(PostCards.name, PostCards);

Vue.component(Blog.name, Blog);
Vue.component(Events.name, Events);
Vue.component(EventsTitles.name, EventsTitles);
Vue.component(Positions.name, Positions);

Vue.config.productionTip = false;

new Vue({
    el: '#passion-app',
});
