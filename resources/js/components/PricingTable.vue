<script setup>
import { computed, ref, watch } from 'vue';
import { useRoute, useRouter } from 'vue-router';
import LoadState from './LoadState.vue';
import ChatIcon from './ChatIcon.vue';
import ServiceIcon from './ServiceIcon.vue';
import ProjectCard from './ProjectCard.vue';
import { planGroups, priceLabel, planMessage, whatsappLink } from '../lib/site';
import { cycle } from '../lib/reveal';
import { content } from '../lib/api';

// Step 1: the customer taps their type of business. Step 2: they see its 3 packages.
const route = useRoute();
const router = useRouter();
const valid = (key) => planGroups.some((g) => g.key === key);
const active = ref(valid(route.query.type) ? route.query.type : 'business');

watch(() => route.query.type, (type) => valid(type) && (active.value = type));

function choose(key) {
    active.value = key;
    router.replace({ query: { ...route.query, type: key }, hash: '#packages' });
}

const group = computed(() => planGroups.find((g) => g.key === active.value));
const plans = computed(() => content.plans.filter((p) => p.category === active.value));
const examples = computed(() => content.projects.filter((p) => p.industry === active.value));
</script>

<template>
    <div>
        <h2 v-reveal class="h-section">1. What is your business?</h2>
        <p v-reveal="{ dir: 'up', delay: 80 }" class="lead mt-2">Tap your type of business to see its 3 packages.</p>

        <div class="mt-7 grid grid-cols-2 gap-3 sm:grid-cols-3 lg:grid-cols-7" role="group" aria-label="Type of business">
            <button
                v-for="(item, i) in planGroups"
                :key="item.key"
                v-reveal="{ dir: i % 2 ? 'down' : 'up', delay: i * 60 }"
                type="button"
                :aria-pressed="active === item.key"
                class="flex cursor-pointer flex-col items-center gap-2 rounded-2xl border-2 px-3 py-4 text-center text-sm font-bold transition-all"
                :class="active === item.key
                    ? 'border-accent bg-accent text-white shadow-[0_14px_30px_-14px_rgba(14,159,110,0.9)]'
                    : 'border-line bg-white text-ink hover:-translate-y-1 hover:border-accent'"
                @click="choose(item.key)"
            >
                <span class="grid size-12 place-items-center rounded-xl" :class="active === item.key ? 'bg-white/20' : 'bg-accent-soft text-accent'">
                    <ServiceIcon :name="item.icon" class="size-7" />
                </span>
                {{ item.short }}
            </button>
        </div>

        <section id="packages" class="mt-14 scroll-mt-28" aria-live="polite">
            <h2 class="h-section">2. {{ group.title }}</h2>
            <p class="lead mt-2">{{ group.text }}</p>

            <LoadState what="prices">
                <div :key="active" class="mt-8 grid items-start gap-6 md:grid-cols-3">
                    <article
                        v-for="(plan, i) in plans"
                        :key="plan.id"
                        v-reveal="cycle(i, 120)"
                        class="relative flex h-full flex-col rounded-2xl p-6 sm:p-7"
                        :class="plan.is_popular ? 'band-night shadow-[0_30px_60px_-30px_rgba(11,27,51,0.9)]' : 'border-2 border-line bg-white'"
                    >
                        <span v-if="plan.is_popular" class="absolute -top-3.5 left-6 rounded-full bg-sun px-3 py-1 text-sm font-bold text-night">
                            Most chosen
                        </span>

                        <h3 class="text-2xl">{{ plan.name }}</h3>
                        <p class="mt-1" :class="plan.is_popular ? 'text-white/75' : 'text-body'">{{ plan.best_for }}</p>

                        <p class="mt-5 font-display text-3xl font-extrabold tabular-nums" :class="plan.is_popular ? 'text-sun' : 'text-ink'">
                            {{ priceLabel(plan) }}
                        </p>
                        <p class="mt-1 text-sm font-semibold" :class="plan.is_popular ? 'text-white/65' : 'text-muted'">
                            {{ plan.billing === 'one-time' ? 'One-time payment' : 'Per month' }}
                        </p>

                        <ul class="mt-6 grow space-y-2.5 border-t pt-6" :class="plan.is_popular ? 'border-white/15' : 'border-line'">
                            <li v-for="feature in plan.features" :key="feature" class="flex gap-2.5">
                                <svg viewBox="0 0 20 20" class="mt-1 size-5 shrink-0" :class="plan.is_popular ? 'text-mint' : 'text-accent'" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <path d="M4 10.5l4 4 8-9" />
                                </svg>
                                <span>{{ feature }}</span>
                            </li>
                        </ul>

                        <a :href="whatsappLink(planMessage(plan))" target="_blank" rel="noopener" class="btn btn-whatsapp mt-7 w-full">
                            <ChatIcon class="size-5" /> Order on WhatsApp
                        </a>
                        <RouterLink
                            :to="{ path: '/contact', query: { plan: `${group.title} – ${plan.name} (${priceLabel(plan)})` } }"
                            class="mt-3 block text-center text-sm font-semibold underline underline-offset-4"
                            :class="plan.is_popular ? 'text-white/80 decoration-white/40 hover:text-sun' : 'text-accent decoration-accent/40 hover:text-accent-strong'"
                        >
                            or fill a short form
                        </RouterLink>
                    </article>
                </div>

                <div v-if="examples.length" :key="`ex-${active}`" class="mt-16">
                    <h3 v-reveal class="text-2xl">Websites like this</h3>
                    <p v-reveal="{ dir: 'up', delay: 80 }" class="mt-1 text-body">Ideas for your {{ group.short.toLowerCase() }} website. Tell us which one you like.</p>
                    <div class="mt-6 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                        <ProjectCard v-for="(project, i) in examples" :key="project.id" v-reveal="cycle(i)" :project="project" />
                    </div>
                </div>
            </LoadState>
        </section>
    </div>
</template>
