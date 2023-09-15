const {
    getBlockTypes,
    unregisterBlockType,
    getBlockVariations,
    unregisterBlockVariation,
    domReady,
} = wp.blocks;

import allowedBlocks from './allowed-blocks.js';
import allowedVariationBlocks from './allowed-variation-blocks.js';

/**
 * @author Keith Murphy | nomadmystics@gmail.com
 * @description Build the dynamic functionality we need for the Event ACF options page.
 *
 * @return {{init: init}}
 */
const blockEditor = (() => {
    /**
     * @description Start our functionality here
     * @author Keith Murphy | nomadmystics@gmail.com
     *
     * @return void
     */
    const init = () => {
        // Wait for the WP dom to be ready
        wp.domReady(function() {

            unregisterCoreBlocks();
            unregisterCoreVariationsBlocks();

        });

        window.addEventListener('DOMContentLoaded', () => {

            updateHTMLStyle();

        });
    };

    /**
     * @description Only allow curtain blocks
     * @author Keith Murphy | nomadmystics@gmail.com
     *
     * @return void
     */
    const unregisterCoreBlocks = () => {
        wp.blocks.getBlockTypes().forEach((blockType) => {
            if (allowedBlocks.indexOf(blockType.name) === -1) {
                wp.blocks.unregisterBlockType(blockType.name);
            }

            // console.log(blockType.name);
        });
    };

    /**
     * @author Keith Murphy | nomadmystics@gmail.com
     * @description Only allow certain variation blocks ie embeds
     *
     * @return void
     */
    const unregisterCoreVariationsBlocks = () => {
        wp.blocks.getBlockVariations('core/embed').forEach((blockType) => {

            if (allowedVariationBlocks.indexOf(blockType.name) === -1 ) {
                wp.blocks.unregisterBlockVariation('core/embed', blockType.name);
            }

            // console.log(blockType.name);
        });
    };

    /**
     * @description Force the HTML Element font style in the editor
     * @author Keith Murphy | nomadmystics@gmail.com
     *
     * @return void
     */
    const updateHTMLStyle = () => {
        const htmlElement = window.document.documentElement;

        console.dir(htmlElement);

        htmlElement.style.fontSize = '62.5%';

    };

    return {
        init,
    }
})();

export default blockEditor;
