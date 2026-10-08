<script setup>
import { computed, ref } from 'vue';
import FilterTabs from './FilterTabs.vue';
import LoadState from './LoadState.vue';
import { categoryLabel, formatUSD } from '../lib/site';
import { content } from '../lib/api';

const active = ref('development');
const plans = computed(() => content.plans.filter((p) => p.category === active.value));
</script>

<template>
    <div>
        <FilterTabs v-model="active" label="Pricing category" />

        <LoadState what="prices">
        <div class="mt-10 grid items-start gap-6 lg:grid-cols-3">
            <article
                v-for="plan in plans"
                :key="plan.id"
                class="flex h-full flex-col rounded-2xl p-7 sm:p-8"
                :class="plan.is_popular ? 'band-night shadow-[0_30px_60px_-30px_rgba(11,36,31,0.9)]' : 'border border-line bg-white'"
            >
                <div class="flex items-center justify-between gap-3">
                    <h3 class="text-2xl">{{ plan.name }}</h3>
                    <span v-if="plan.is_popular" class="rounded-full bg-sun px-3 py-1 text-sm font-bold text-night">
                        Most chosen
                    </span>
                </div>
                <p class="mt-2" :class="plan.is_popular ? 'text-white/70' : 'text-body'">{{ plan.best_for }}</p>

                <p class="mt-6 font-display text-4xl font-extrabold tabular-nums" :class="plan.is_popular ? 'text-sun' : 'text-ink'">{{ formatUSD(plan.price) }}</p>
                <p class="mt-1 text-sm" :class="plan.is_popular ? 'text-white/60' : 'text-muted'">
                    {{ plan.billing === 'one-time' ? 'One-time, starting price' : 'Per month' }}
                </p>

                <ul class="mt-7 grow space-y-3 border-t pt-7" :class="plan.is_popular ? 'border-white/15' : 'border-line'">
                    <li v-for="feature in plan.features" :key="feature" class="flex gap-3">
                        <svg viewBox="0 0 20 20" class="mt-1 size-5 shrink-0" :class="plan.is_popular ? 'text-mint' : 'text-accent'" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M4 10.5l4 4 8-9" />
                        </svg>
                        <span>{{ feature }}</span>
                    </li>
                </ul>

                <RouterLink
                    :to="{ path: '/contact', query: { plan: `${categoryLabel(plan.category)} – ${plan.name}` } }"
                    class="btn mt-8 w-full"
                    :class="plan.is_popular ? 'btn-sun' : 'btn-outline'"
                >
                    Choose {{ plan.name }}
                </RouterLink>
            </article>
        </div>

        </LoadState>
    </div>
</template>
