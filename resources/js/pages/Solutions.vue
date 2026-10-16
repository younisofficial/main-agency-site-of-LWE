<script setup>
import PageHero from '../components/PageHero.vue';
import ServiceIcon from '../components/ServiceIcon.vue';
import ChatIcon from '../components/ChatIcon.vue';
import CallToAction from '../components/CallToAction.vue';
import { solutions, planGroups, whatsappLink } from '../lib/site';

const iconFor = (key) => planGroups.find((g) => g.key === key)?.icon ?? 'shop';
const shortFor = (key) => planGroups.find((g) => g.key === key)?.short ?? key;
</script>

<template>
    <PageHero
        title="Solutions for your business"
        text="Every business has a different problem. See yours, how we solve it, what it costs — and how the website pays for itself."
    >
        <!-- Quick jump to each business -->
        <nav v-reveal="{ dir: 'up', delay: 200 }" class="mt-8 flex flex-wrap gap-2" aria-label="Jump to business">
            <a
                v-for="item in solutions"
                :key="item.key"
                :href="`#${item.key}`"
                class="inline-flex items-center gap-2 rounded-full border-2 border-line bg-white px-4 py-2 text-[0.95rem] font-bold text-ink transition-colors hover:border-accent hover:text-accent"
            >
                <ServiceIcon :name="iconFor(item.key)" class="size-5 text-accent" />
                {{ shortFor(item.key) }}
            </a>
        </nav>
    </PageHero>

    <section
        v-for="(item, i) in solutions"
        :id="item.key"
        :key="item.key"
        class="section scroll-mt-20 overflow-hidden"
        :class="i % 2 ? 'bg-surface' : ''"
        :aria-labelledby="`${item.key}-title`"
    >
        <div class="wrap grid items-center gap-10 lg:grid-cols-2 lg:gap-16">
            <!-- Picture: comes from the left on one row, from the right on the next -->
            <div v-reveal="i % 2 ? 'right' : 'left'" :class="i % 2 ? 'lg:order-2' : ''" class="relative">
                <span class="absolute -inset-3 rounded-[2rem] bg-gradient-to-br from-accent/25 via-mint/20 to-sky/25 blur-xl" aria-hidden="true"></span>
                <img
                    :src="item.image"
                    :alt="`Website and design for ${item.title}`"
                    width="900"
                    height="900"
                    loading="lazy"
                    decoding="async"
                    class="relative aspect-[4/3] w-full rounded-[1.75rem] border-4 border-white object-cover object-top shadow-[0_30px_60px_-30px_rgba(15,23,42,0.55)]"
                />
                <span class="absolute -bottom-4 left-6 flex items-center gap-2 rounded-2xl bg-white px-4 py-2.5 text-sm font-bold text-ink shadow-lg">
                    <ServiceIcon :name="iconFor(item.key)" class="size-5 text-accent" />
                    {{ shortFor(item.key) }}
                </span>
            </div>

            <div>
                <p v-reveal="'down'" class="text-sm font-bold uppercase tracking-widest text-accent">{{ String(i + 1).padStart(2, '0') }}</p>
                <h2 :id="`${item.key}-title`" v-reveal="i % 2 ? 'left' : 'right'" class="h-section mt-2">{{ item.title }}</h2>

                <!-- The problem in one sentence, like the customer would say it -->
                <blockquote v-reveal="{ dir: 'up', delay: 60 }" class="mt-6 rounded-2xl border-l-4 border-red-500 bg-red-50 px-5 py-4 text-lg font-medium text-ink">
                    “{{ item.problem }}”
                </blockquote>

                <div class="mt-5 grid gap-4 sm:grid-cols-2">
                    <div v-reveal="{ dir: 'up', delay: 120 }" class="rounded-2xl border-2 border-red-100 bg-white p-5">
                        <h3 class="flex items-center gap-2 text-lg text-red-700">
                            <span class="grid size-7 place-items-center rounded-full bg-red-100 text-sm" aria-hidden="true">✕</span>
                            The problem
                        </h3>
                        <ul class="mt-3 space-y-2 text-[0.95rem] text-body">
                            <li v-for="p in item.problems" :key="p">{{ p }}</li>
                        </ul>
                    </div>
                    <div v-reveal="{ dir: 'up', delay: 200 }" class="rounded-2xl border-2 border-accent/30 bg-accent-soft/60 p-5">
                        <h3 class="flex items-center gap-2 text-lg text-accent-strong">
                            <span class="grid size-7 place-items-center rounded-full bg-accent text-sm text-white" aria-hidden="true">✓</span>
                            Our solution
                        </h3>
                        <ul class="mt-3 space-y-2 text-[0.95rem] text-ink">
                            <li v-for="x in item.solutions" :key="x">{{ x }}</li>
                        </ul>
                    </div>

                    <!-- Price and how the website pays for itself -->
                    <div v-reveal="{ dir: 'up', delay: 280 }" class="band-night flex flex-col gap-4 rounded-2xl p-5 sm:col-span-2">
                        <div class="flex flex-wrap items-baseline gap-x-3 border-b border-white/15 pb-4">
                            <p class="w-full text-sm font-semibold text-white/70">{{ item.package }} package</p>
                            <p class="font-display text-3xl font-extrabold text-sun">{{ item.price }}</p>
                            <p class="text-sm text-white/70">one-time payment</p>
                        </div>
                        <p class="flex gap-3 text-[0.98rem] text-white/90">
                            <span class="grid size-8 shrink-0 place-items-center rounded-full bg-mint/20 text-mint" aria-hidden="true">₨</span>
                            <span><strong class="text-white">Simple maths:</strong> {{ item.math }}</span>
                        </p>
                    </div>
                </div>

                <div v-reveal="{ dir: 'up', delay: 300 }" class="mt-8 flex flex-wrap gap-3">
                    <RouterLink :to="{ path: '/pricing', query: { type: item.key }, hash: '#packages' }" class="btn btn-sun">
                        See packages and prices
                    </RouterLink>
                    <a :href="whatsappLink(`Assalam o Alaikum! I have a ${shortFor(item.key).toLowerCase()} business and I want a website.`)" target="_blank" rel="noopener" class="btn btn-whatsapp">
                        <ChatIcon class="size-5" /> Ask on WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </section>

    <CallToAction />
</template>
