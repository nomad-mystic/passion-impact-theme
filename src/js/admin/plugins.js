/**
 * @description Hide the plugin DOM elements when we are on a wp_engine site
 * @author Keith Murphy | nomadmystics@gmail.com
 *
 * @return {{init: init}}
 */
const plugins = (() => {
    /**
     * @description Start our functionality here
     * @author Keith Murphy | nomadmystics@gmail.com
     *
     * @return void
     */
    const init = () => {
        window.addEventListener('DOMContentLoaded', () => {
            hidePluginElements();
        });
    };

    /**
     * @description This will remove the installation button from the plugins page and generally clean up the plugins page/menu
     * @author Keith Murphy | nomadmystics@gmail.com
     *
     * @return void
     */
    const hidePluginElements = () => {
        // Check if we are on a wp_engine site
        const isWpEngineSiteElement = window.document.getElementById('is-wp-engine-site');
        const isWpEngineSite = isWpEngineSiteElement.dataset.isWpEngineSite;

        if (isWpEngineSite && typeof isWpEngineSite !== 'undefined' && isWpEngineSite === 'true') {

            // Remove from all admin pages
            const menuPlugins = window.document.querySelector('#menu-plugins li a[href="plugin-install.php"]');
            menuPlugins.style.display = 'none';

            // Make sure we are on the right page
            if (window.location.href.includes('/wp-admin/plugins.php')) {
                // DOM Elements
                const pageTitleAction = window.document.querySelector('.page-title-action');
                const pluginSearchInput = window.document.getElementById('plugin-search-input');
                const bulkActionsTop = window.document.querySelector('.top .bulkactions');
                const bulkActionsBottom = window.document.querySelector('.bottom .bulkactions');
                const checkColumn = Array.from(window.document.querySelectorAll('.check-column'));
                const deactivateButtons = Array.from(window.document.querySelectorAll('.deactivate'))

                // Hide our DOM elements
                pageTitleAction.style.display = 'none';
                pluginSearchInput.style.display = 'none';
                bulkActionsBottom.style.display = 'none';

                bulkActionsTop.style.display = 'none';
                // Fix the UI
                bulkActionsTop.closest('.tablenav').style.clear = 'none';
                bulkActionsTop.closest('.tablenav').style.height = '0';

                // Remove the checkboxes for bulk actions
                for (let col = 0; col < checkColumn.length; col++) {
                    if (checkColumn[col] && typeof checkColumn[col] !== 'undefined') {
                        checkColumn[col].style.display = 'none';
                    }
                } // End for

                // Remove the deactivate button
                for (let button = 0; button < deactivateButtons.length; button++) {
                    if (deactivateButtons[button] && typeof deactivateButtons[button] !== 'undefined') {
                        deactivateButtons[button].style.display = 'none';
                    }
                } // End for
            } // End if
        } // End if


    } // End hidePluginElements

    return {
        init,
    }
})();

export default plugins;
