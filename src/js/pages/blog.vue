<template>
    <div class="blog__container">
        <section>
            <div class="blog__header">
                <div class="blog__header-title">
                    <h1>2018 Blog Posts</h1>
                </div>
                <div class="blog__header-navigation">
                    <ul>
                        <li>Jan</li>
                        <li>Feb</li>
                        <li>Mar</li>
                        <li>Apr</li>
                        <li>May</li>
                        <li>Jun</li>
                        <li>Jul</li>
                        <li>Aug</li>
                        <li>Sep</li>
                        <li>Oct</li>
                        <li>Nov</li>
                        <li>Dec</li>
                    </ul>
                </div>
            </div>
        </section>

        <slot />
    </div>
</template>

<script>
    export default {
        name: 'blog',
    };
</script>
