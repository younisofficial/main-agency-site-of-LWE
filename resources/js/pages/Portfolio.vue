<script setup>
import { computed, ref } from "vue";
import PageHero from "../components/PageHero.vue";
import LoadState from "../components/LoadState.vue";
import ProjectCard from "../components/ProjectCard.vue";
import CallToAction from "../components/CallToAction.vue";
import { content } from "../lib/api";
import { planGroups } from "../lib/site";
import { cycle } from "../lib/reveal";

const ours = computed(() =>
    content.projects.filter((p) => p.kind !== "example"),
);

// Website ideas from the market, grouped by type of business.
const filter = ref("all");
const groupsWithExamples = computed(() =>
    planGroups.filter((g) =>
        content.projects.some(
            (p) => p.kind === "example" && p.industry === g.key,
        ),
    ),
);
const examples = computed(() =>
    content.projects.filter(
        (p) =>
            p.kind === "example" &&
            (filter.value === "all" || p.industry === filter.value),
    ),
);
</script>

<template>
    <PageHero
        title="Our work"
        text="Websites our team has made, and website ideas for every type of business."
    />

    <section class="section">
        <div class="wrap">
            <h2 v-reveal="'left'" class="h-section">Made by our team</h2>
            <div class="mt-8">
                <LoadState what="projects">
                    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                        <ProjectCard
                            v-for="(project, i) in ours"
                            :key="project.id"
                            v-reveal="cycle(i)"
                            :project="project"
                        />
                    </div>
                </LoadState>
            </div>
        </div>
    </section>

    <section
        v-if="groupsWithExamples.length"
        class="section border-t border-line bg-surface"
    >
        <div class="wrap">
            <h2 v-reveal="'right'" class="h-section">
                Website ideas by business
            </h2>
            <p v-reveal="{ dir: 'right', delay: 80 }" class="lead mt-3">
                Popular websites from the market. Pick one you like — we will
                make yours in the same style.
            </p>

            <div
                v-reveal
                class="mt-7 flex flex-wrap gap-2"
                role="group"
                aria-label="Type of business"
            >
                <button
                    v-for="tab in [
                        { key: 'all', short: 'All' },
                        ...groupsWithExamples,
                    ]"
                    :key="tab.key"
                    type="button"
                    :aria-pressed="filter === tab.key"
                    class="cursor-pointer rounded-full border-2 px-4 py-2 text-[0.95rem] font-bold transition-colors"
                    :class="
                        filter === tab.key
                            ? 'border-accent bg-accent text-white'
                            : 'border-line bg-white text-ink hover:border-accent'
                    "
                    @click="filter = tab.key"
                >
                    {{ tab.short }}
                </button>
            </div>

            <div
                :key="filter"
                class="mt-8 grid gap-6 md:grid-cols-2 lg:grid-cols-3"
            >
                <ProjectCard
                    v-for="(project, i) in examples"
                    :key="project.id"
                    v-reveal="cycle(i)"
                    :project="project"
                />
            </div>
        </div>
    </section>

    <CallToAction />
</template>
