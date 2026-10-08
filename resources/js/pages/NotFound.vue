<script setup>
import PageHero from '../components/PageHero.vue';
</script>

<template>
    <PageHero title="This page does not exist" text="The link may be old or mistyped. Start again from the homepage or see what we offer.">
        <div class="mt-8 flex flex-wrap gap-3">
            <RouterLink to="/" class="btn btn-sun">Go to homepage</RouterLink>
            <RouterLink to="/services" class="btn btn-ghost">See all services</RouterLink>
        </div>
    </PageHero>
</template>
