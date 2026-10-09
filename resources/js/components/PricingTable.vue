<script setup>
import { computed } from 'vue';
import LoadState from './LoadState.vue';
import ChatIcon from './ChatIcon.vue';
import { planGroups, priceLabel, planMessage, whatsappLink } from '../lib/site';
import { content } from '../lib/api';

// Every price table is shown one under the other — no tabs to click.
const groups = computed(() =>
    planGroups
        .map((group) => ({ ...group, plans: content.plans.filter((p) => p.category === group.key) }))
        .filter((group) => group.plans.length),
);
</script>

<template>
    <LoadState what="prices">
        <div class="space-y-20">
            <section v-for="group in groups" :key="group.key" :aria-labelledby="`plans-${group.key}`">
                <h2 :id="`plans-${group.key}`" class="h-section scroll-mt-28">{{ group.title }}</h2>
                <p class="lead mt-2">{{ group.text }}</p>

                <div class="mt-8 grid items-start gap-6 sm:grid-cols-2" :class="group.plans.length > 3 ? '' : 'lg:grid-cols-3'">
                    <article
                        v-for="plan in group.plans"
                        :key="plan.id"
                        class="relative flex h-full flex-col rounded-2xl p-6 sm:p-7"
                        :class="plan.is_popular ? 'band-night shadow-[0_30px_60px_-30px_rgba(11,36,31,0.9)]' : 'border-2 border-line bg-white'"
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
            </section>
        </div>
    </LoadState>
</template>
