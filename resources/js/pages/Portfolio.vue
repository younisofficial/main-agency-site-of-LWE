<script setup>
import { computed, ref } from 'vue';
import PageHero from '../components/PageHero.vue';
import FilterTabs from '../components/FilterTabs.vue';
import LoadState from '../components/LoadState.vue';
import ProjectCard from '../components/ProjectCard.vue';
import CallToAction from '../components/CallToAction.vue';
import { content } from '../lib/api';

const filter = ref('all');
const shown = computed(() =>
    filter.value === 'all' ? content.projects : content.projects.filter((p) => p.category === filter.value),
);
</script>

<template>
    <PageHero
        title="Our work"
        text="Websites, apps, brands and campaigns we have built for clients. Filter by the kind of work you need."
    />

    <section class="section pb-0!">
        <div class="wrap">
            <FilterTabs v-model="filter" all-label="All work" label="Filter projects" />

            <div class="mt-8">
                <LoadState what="projects">
                    <div v-if="shown.length" class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                        <ProjectCard v-for="project in shown" :key="project.id" :project="project" />
                    </div>
                    <p v-else class="rounded-2xl border border-line bg-surface p-6 text-body">
                        No projects in this group yet. Choose another group to see more work.
                    </p>
                </LoadState>
            </div>
        </div>
    </section>

    <CallToAction />
</template>
