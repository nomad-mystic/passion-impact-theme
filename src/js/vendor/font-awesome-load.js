// Add font-awesome
import { library, config, dom } from '@fortawesome/fontawesome-svg-core';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';

import {
    faBars,
    faTimes,
    faPlus,
    faAngleLeft,
    faAngleRight,
    faGithub,
    faFacebook,
    faInstagram,
    faTwitter,
    faYoutube,
    faLinkedin,
    // faExternalLinkAlt,
    faEnvelope,
    faGlobe,
} from './font-awesome-icons';

library.add(
    faBars,
    faTimes,
    faPlus,
    faAngleLeft,
    faAngleRight,
    faGithub,
    faFacebook,
    faInstagram,
    faTwitter,
    faYoutube,
    faLinkedin,
    // faExternalLinkAlt,
    faEnvelope,
    faGlobe,
);

config.autoReplaceSvg = true;
config.searchPseudoElements = true;

dom.watch();

export {
    FontAwesomeIcon,
}
