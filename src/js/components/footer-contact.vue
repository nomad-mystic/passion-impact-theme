<template>
    <div class="contact-details__details">
        <address>
            <a class="email" :href="`mailto:${this.email}`">{{ this.email }}</a>
            <a class="phone" :href="`tel:+1${this.phone}`">{{ this.phone }}</a>
            <a :href="`http://maps.google.com/?q=1200 ${this.address}`" target="_blank">{{ this.address }}</a>
        </address>
    </div>
</template>

<script>
    export default {
        name: 'footer-contact',
        props: {
            email: {
              type: String,
              default: '',
            },
            phone: {
              type: String,
              default: '',
            },
            address: {
              type: String,
              default: '',
            },
        },
    };
</script>
