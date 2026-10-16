<script setup>
import { computed, watchEffect } from 'vue';
import ServiceIcon from '../components/ServiceIcon.vue';
import ServiceCard from '../components/ServiceCard.vue';
import CallToAction from '../components/CallToAction.vue';
import { content } from '../lib/api';
import { categories, site, whatsappLink } from '../lib/site';
import ChatIcon from '../components/ChatIcon.vue';
import { applySeo, notFoundSeo } from '../lib/seo';
import { cycle } from '../lib/reveal';

const props = defineProps({ slug: { type: String, required: true } });

const service = computed(() => content.services.find((s) => s.slug === props.slug));
const related = computed(() =>
    content.services.filter((s) => s.category === service.value?.category && s.slug !== props.slug),
);
const categoryLabel = computed(() => categories.find((c) => c.key === service.value?.category)?.label);

watchEffect(() => {
    if (service.value) {
        applySeo({
            title: `${service.value.title} in Multan, Pakistan | ${site.name}`,
            description: `${service.value.summary} ${service.value.description}`.slice(0, 155),
            path: `/services/${props.slug}`,
        });
    } else if (content.ready) {
        applySeo(notFoundSeo(`/services/${props.slug}`));
    }
});
</script>

<template>
    <template v-if="service">
        <section class="section pb-0!" :class="`tone-${service.category}`">
            <div class="wrap">
                <nav class="text-muted" aria-label="Breadcrumb">
                    <RouterLink to="/services" class="link">Services</RouterLink>
                    <span class="mx-2" aria-hidden="true">/</span>{{ categoryLabel }}
                </nav>

                <div class="mt-8 grid gap-12 lg:grid-cols-[1.5fr_1fr]">
                    <div>
                        <span class="grid size-16 place-items-center rounded-2xl bg-[var(--tone-soft)] text-[var(--tone)]">
                            <ServiceIcon :name="service.icon" class="size-8" />
                        </span>
                        <h1 class="mt-6 text-4xl font-extrabold sm:text-6xl">{{ service.title }}</h1>
                        <p class="mt-6 max-w-2xl text-xl leading-relaxed text-body">{{ service.description }}</p>

                        <h2 class="mt-12 text-2xl">What you get</h2>
                        <ul class="mt-5 max-w-2xl space-y-3">
                            <li v-for="(item, i) in service.deliverables" :key="item" v-reveal="{ dir: 'left', delay: i * 60 }" class="flex gap-3 rounded-xl border border-line bg-white px-5 py-3.5 font-medium text-ink">
                                <svg viewBox="0 0 20 20" class="mt-1 size-5 shrink-0 text-[var(--tone)]" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <path d="M4 10.5l4 4 8-9" />
                                </svg>
                                {{ item }}
                            </li>
                        </ul>
                    </div>

                    <aside v-reveal="'right'" class="band-night h-fit rounded-3xl p-7 shadow-[0_30px_60px_-30px_rgba(11,36,31,0.9)] sm:p-8 lg:sticky lg:top-28">
                        <h2 class="text-2xl">Want this service?</h2>
                        <p class="mt-2 text-white/75">Send us a WhatsApp message. We will tell you the price and time.</p>
                        <dl class="mt-6 border-t border-white/15 pt-5">
                            <div class="flex justify-between gap-4">
                                <dt class="text-white/65">Time needed</dt>
                                <dd class="font-semibold">{{ service.timeline }}</dd>
                            </div>
                        </dl>
                        <a :href="whatsappLink(`Assalam o Alaikum! I want ${service.title}. Please tell me the price.`)" target="_blank" rel="noopener" class="btn btn-whatsapp mt-7 w-full">
                            <ChatIcon class="size-5" /> Ask on WhatsApp
                        </a>
                        <RouterLink to="/pricing" class="btn btn-ghost mt-3 w-full">See our prices</RouterLink>
                        <RouterLink :to="{ path: '/contact', query: { services: service.slug } }" class="mt-4 block text-center font-semibold text-white underline decoration-white/40 underline-offset-4 hover:text-sun">
                            or fill a short form
                        </RouterLink>
                    </aside>
                </div>

                <div v-if="related.length" class="mt-20">
                    <h2 class="text-2xl">More in {{ categoryLabel?.toLowerCase() }}</h2>
                    <div class="mt-6 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                        <ServiceCard v-for="(item, i) in related" :key="item.slug" v-reveal="cycle(i)" :service="item" />
                    </div>
                </div>
            </div>
        </section>
        <CallToAction />
    </template>

    <section v-else-if="content.ready" class="section">
        <div class="wrap">
            <h1 class="text-4xl">We do not offer that service</h1>
            <p class="lead mt-4">The link may be old. Every service we offer is on the services page.</p>
            <RouterLink to="/services" class="btn btn-primary mt-8">See all services</RouterLink>
        </div>
    </section>

    <section v-else class="section">
        <p class="wrap text-muted" aria-live="polite">
            {{ content.failed ? 'This page did not load. Check your connection and refresh.' : 'Loading…' }}
        </p>
    </section>
</template>
