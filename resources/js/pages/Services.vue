<script setup>
import PageHero from '../components/PageHero.vue';
import ServiceGrid from '../components/ServiceGrid.vue';
import CallToAction from '../components/CallToAction.vue';
</script>

<template>
    <PageHero
        title="Services"
        text="Everything a business needs to get online and grow there. Open any service to see what is included, how long it takes and what it costs."
    />
    <section class="section pb-0!">
        <div class="wrap">
            <ServiceGrid />
        </div>
    </section>
    <CallToAction />
</template>
