<template>
    <div class="google-map-component">
        <div id="google-map-element" data-zoom="10"></div>
    </div>
</template>

<script>
    export default {
        name: 'google-map',
        props: {
            googleKey: {
                default: '',
                type: String,
            },
            mapSites: {
                default: '',
                type: String,
            },
        },
        data() {
            return {
                scriptSourceBase: 'https://maps.googleapis.com/maps/api/js?key=',
                piLatLng: {
                    lat: 45.497229,
                    lng: -122.6121567,
                },
                mapSitesData: [],
            };
        },
        methods: {
            /**
             * @description Append the google map script to the body element
             *
             * @return void
             */
            addGoogleMapScript() {
                // Build our script
                const googleScriptElement = window.document.createElement('SCRIPT');
                googleScriptElement.src = `${this.scriptSourceBase}${this.googleKey}`;
                googleScriptElement.type = 'text/javascript';

                // Grab and append our script
                const bodyElement = window.document.body;
                bodyElement.appendChild(googleScriptElement);
            },

            /**
             * @author Keith Murphy | nomadmystics@gmail.com
             *
             * @return {object}
             */
            initMap() {
                const mapElement = window.document.getElementById('google-map-element');

                // Create gerenic map.
                // Passion Impact
                // 45.497229,-122.6121567
                const myLatLng = { lat: 45.497229, lng: -122.6121567 };

                if (window.google && typeof window.google !== 'undefined') {
                    const mapArgs = {
                        zoom        : Number(mapElement.dataset.zoom) || 4,
                        mapTypeId   : window.google.maps.MapTypeId.ROADMAP,
                        center: this.piLatLng,
                    };

                    const map = new window.google.maps.Map(mapElement, mapArgs);

                    this.createMarkers(map);
                }
            },

            /**
             * @author Keith Murphy | nomadmystics@gmail.com
             *
             * @param {StreetViewPanorama} map
             * @return void
             */
            createMarkers(map) {
                const sites = this.mapSitesData;

                if (window.google && typeof window.google !== 'undefined') {
                    for (let site = 0; site < sites.length; site++) {
                        if (sites[site] && typeof sites[site] !== 'undefined') {
                            // console.log(sites[site]);

                            // Build our description
                            const siteDescription = `<div class="google-map-infowindow">
                                <figure>
                                    <a href='${sites[site].site_info.Link}' target="_blank">
                                        <img src='${sites[site].site_info.logo.url}' alt='${sites[site].site_info.logo.alt}'>
                                    </a>
                                </figure>
                                <h3 class="page-sub-title">${sites[site].site_info.name}</h3>
                                <p class="page-paragraph">${sites[site].site_info.description}</p>
                            </div>
                            `;

                            const marker = this.buildMarker(map, sites, site);

                            this.buildInfoWindow(map, marker, siteDescription);
                        }
                    }
                }
            },

            /**
             * @description Build our marker for the map
             * @author Keith Murphy | nomadmystics@gmail.com
             *
             * @param {StreetViewPanorama} map
             * @param {array} sites
             * @param {number} site
             * @return
             */
            buildMarker(map, sites, site) {
                // Create our marker
                const marker = new google.maps.Marker({
                    position: {
                        lat: Number(sites[site].map_info.latitude),
                        lng: Number(sites[site].map_info.longitude),
                    },
                    map,
                    title: `${sites[site].site_info.name}`,
                });

                return marker;
            },

            /**
             * @author Keith Murphy | nomadmystics@gmail.com
             * @description Build our infowindow the map
             *
             * @param {StreetViewPanorama} map
             * @param {MVCObject} marker
             * @param {string} siteDescription
             * @return void
             */
            buildInfoWindow(map, marker, siteDescription) {
                const infowindow = new google.maps.InfoWindow();
                let prev_infowindow = false;

                // Build the infowindow
                window.google.maps.event.addListener(marker, 'click', (function(marker, siteDescription, infowindow) {
                    return function() {
                        infowindow.close();
                        infowindow.setContent(siteDescription);
                        infowindow.open(map, marker);
                    };
                })(marker, siteDescription, infowindow));
            }
        },
        beforeMount() {
            this.addGoogleMapScript();
        },
    };
</script>
