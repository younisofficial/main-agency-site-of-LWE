<script setup>
import PageHero from '../components/PageHero.vue';
import ContactForm from '../components/ContactForm.vue';
import { site, whatsappLink } from '../lib/site';
</script>

<template>
    <PageHero title="Get a free quote" text="Tell us about your project. We reply within one working day." />

    <section class="section">
        <div class="wrap grid gap-14 lg:grid-cols-[1.6fr_1fr]">
            <div class="rounded-3xl border border-line bg-white p-6 sm:p-9">
                <ContactForm />
            </div>

            <aside class="band-night h-fit rounded-3xl p-7 sm:p-8">
                <h2 class="text-2xl">Prefer to talk?</h2>
                <dl class="mt-6 space-y-5">
                    <div>
                        <dt class="text-sm font-semibold text-mint">Phone</dt>
                        <dd><a :href="`tel:${site.phone.replace(/\s/g, '')}`" class="font-semibold underline decoration-white/40 underline-offset-4 hover:text-sun">{{ site.phone }}</a></dd>
                    </div>
                    <div>
                        <dt class="text-sm font-semibold text-mint">Email</dt>
                        <dd><a :href="`mailto:${site.email}`" class="font-semibold underline decoration-white/40 underline-offset-4 hover:text-sun">{{ site.email }}</a></dd>
                    </div>
                    <div>
                        <dt class="text-sm font-semibold text-mint">Office</dt>
                        <dd>{{ site.address }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-semibold text-mint">Hours</dt>
                        <dd>{{ site.hours }}</dd>
                    </div>
                </dl>
                <a :href="whatsappLink()" target="_blank" rel="noopener" class="btn btn-sun mt-8 w-full">Chat on WhatsApp</a>
            </aside>
        </div>
    </section>
</template>
