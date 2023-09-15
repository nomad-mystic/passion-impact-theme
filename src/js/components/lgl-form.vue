<template>
    <div :id="`lgl-form-${this.iframeId}`" class="lgl-form">
        <slot />
    </div>
</template>

<script>
    import postscribe from 'postscribe';

    export default {
        name: 'lgl-form',
        props: {
            iframeId: {
                default: '',
                type: String,
            },
            permalink: {
                default: '',
                type: String,
            },
        },
        methods: {
            /**
             * @description Build our LGL form and append it to the DOM
             * @author Keith Murphy | nomadmystics@gmail.com
             *
             * @return void
             */
            deferIframe() {
                if (this.permalink && this.permalink.includes(window.location.pathname)) {
                    // Build our script
                    const littleGreenLightScript = window.document.createElement('SCRIPT');
                    littleGreenLightScript.src = `https://secure.lglforms.com/form_engine/s/${this.iframeId}.js`;
                    littleGreenLightScript.defer = true;
                    littleGreenLightScript.type = 'application/javascript';

                    // Append and load our script
                    postscribe(`#lgl-form-${this.iframeId}`, `<script defer="true" type="application/javascript" src="https://secure.lglforms.com/form_engine/s/${this.iframeId}.js"><\/script>`);
                }
            },
        },
        mounted() {

            window.addEventListener('load', this.deferIframe);

        },
    };
</script>
