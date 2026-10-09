<script setup>
import PageHero from '../components/PageHero.vue';
import ServiceGrid from '../components/ServiceGrid.vue';
import CallToAction from '../components/CallToAction.vue';
</script>

<template>
    <PageHero
        title="Our services"
        text="Websites, design, video and ads — all from one team. Tap a service to see what you get."
    />
    <section class="section pb-0!">
        <div class="wrap">
            <ServiceGrid />
        </div>
    </section>
    <CallToAction />
</template>
