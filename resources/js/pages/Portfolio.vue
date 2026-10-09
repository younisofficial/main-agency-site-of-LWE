<script setup>
import { computed } from 'vue';
import PageHero from '../components/PageHero.vue';
import LoadState from '../components/LoadState.vue';
import ProjectCard from '../components/ProjectCard.vue';
import CallToAction from '../components/CallToAction.vue';
import { content } from '../lib/api';

const shown = computed(() => content.projects);
</script>

<template>
    <PageHero
        title="Our work"
        text="Some of the websites our team has made. Want one like these? Message us on WhatsApp."
    />

    <section class="section pb-0!">
        <div class="wrap">
            <div>
                <LoadState what="projects">
                    <div v-if="shown.length" class="grid gap-6 md:grid-cols-2">
                        <ProjectCard v-for="project in shown" :key="project.id" :project="project" />
                    </div>
                    <p v-else class="rounded-2xl border border-line bg-surface p-6 text-body">
                        New projects are coming soon.
                    </p>
                </LoadState>
            </div>
        </div>
    </section>

    <CallToAction />
</template>
