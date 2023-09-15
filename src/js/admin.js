import eventsACFPage from './admin/events';
import plugins from './admin/plugins';

// Make sure we are on the right page
if (window.location.href.includes('acf-options-events')) {
    eventsACFPage.init();
}

plugins.init();
