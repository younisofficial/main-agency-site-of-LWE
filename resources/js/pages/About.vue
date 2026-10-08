<script setup>
import PageHero from '../components/PageHero.vue';
import CallToAction from '../components/CallToAction.vue';
import TeamOrbit from '../components/TeamOrbit.vue';
import { site } from '../lib/site';

const tones = ['development', 'design', 'marketing'];

const values = [
    { title: 'Say the price first', text: 'You should know what something costs before you spend an hour on a call. Our plans are public and our quotes are fixed.' },
    { title: 'One team, one contact', text: 'Developers, designers and marketers sit together, and you talk to one project manager who knows all of it.' },
    { title: 'Show work every week', text: 'You see progress on a real link every week, so nothing is a surprise on launch day.' },
    { title: 'Hand over everything', text: 'Code, design files, logins and documentation are yours. You are never locked in to us.' },
];
</script>

<template>
    <PageHero title="We build, design and market for businesses that want it done properly." />

    <section class="section">
        <div class="wrap">
            <div class="grid gap-8 text-lg text-body lg:grid-cols-2">
                <p>
                    {{ site.name }} is a digital agency based in Pakistan. We started because small and mid-sized businesses kept
                    hiring one freelancer for the website, another for the logo and a third for ads — and getting three
                    things that did not fit together.
                </p>
                <p>
                    So we put all three under one roof. The people who design your site sit next to the people who build
                    it and the people who bring visitors to it. That is why the work lines up, and why it ships on time.
                </p>
            </div>
        </div>
    </section>

    <section class="section border-y border-line bg-surface">
        <div class="wrap">
            <h2 class="h-section">How we work</h2>
            <div class="mt-10 grid gap-5 md:grid-cols-2">
                <div v-for="(value, index) in values" :key="value.title" class="card-lift rounded-2xl border border-line bg-white p-7" :class="`tone-${tones[index % 3]}`">
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
