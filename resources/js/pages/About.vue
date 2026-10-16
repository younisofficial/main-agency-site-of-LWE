<script setup>
import PageHero from '../components/PageHero.vue';
import CallToAction from '../components/CallToAction.vue';
import TeamOrbit from '../components/TeamOrbit.vue';
import { site } from '../lib/site';

const tones = ['development', 'design', 'marketing'];

const values = [
    { title: 'Clear prices', text: 'Our prices are written on the website in rupees. We tell you the exact price before we start.' },
    { title: 'One person to talk to', text: 'Our project manager talks to you on WhatsApp and keeps you updated. No confusion.' },
    { title: 'See your work before it goes live', text: 'We show you your website or design while we make it, so you can ask for changes.' },
    { title: 'Everything is yours', text: 'After the final payment, your website, domain and files belong to you.' },
];
</script>

<template>
    <PageHero title="About us" text="We are a small team in Multan, Pakistan that helps businesses and schools get online and get more customers." />

    <section class="section">
        <div class="wrap">
            <div class="grid gap-8 text-lg text-body lg:grid-cols-2">
                <p v-reveal="'left'">
                    Many businesses hire one person for the website, another for the logo and someone else for ads.
                    The work does not match, and it takes a long time.
                </p>
                <p v-reveal="'right'">
                    At {{ site.name }} one team does all of it: website, logo and design, video editing and Facebook or Google ads.
                    You talk to one person, and everything matches.
                </p>
            </div>
        </div>
    </section>

    <section class="section border-y border-line bg-surface">
        <div class="wrap">
            <h2 v-reveal class="h-section">Our promise to you</h2>
            <div class="mt-10 grid gap-5 md:grid-cols-2">
                <div v-for="(value, index) in values" :key="value.title" v-reveal="{ dir: index % 2 ? 'right' : 'left', delay: (index % 2) * 120 }" class="card-lift rounded-2xl border border-line bg-white p-7" :class="`tone-${tones[index % 3]}`">
                    <span class="block h-1.5 w-12 rounded-full bg-[var(--tone)]" aria-hidden="true"></span>
                    <h3 class="mt-5 text-2xl">{{ value.title }}</h3>
                    <p class="mt-2 max-w-md text-body">{{ value.text }}</p>
                </div>
            </div>
        </div>
    </section>

    <TeamOrbit />

    <CallToAction />
</template>
