<script setup>
import PageHero from '../components/PageHero.vue';
import ContactForm from '../components/ContactForm.vue';
import ChatIcon from '../components/ChatIcon.vue';
import PhoneIcon from '../components/PhoneIcon.vue';
import { site, whatsappLink, phoneLink } from '../lib/site';
</script>

<template>
    <PageHero title="Contact us" text="The fastest way is WhatsApp. You can also call us, or fill the short form and we will call you back.">
        <div class="mt-8 flex flex-wrap gap-3">
            <a :href="whatsappLink()" target="_blank" rel="noopener" class="btn btn-whatsapp btn-lg">
                <ChatIcon class="size-6" /> WhatsApp us
            </a>
            <a :href="phoneLink()" class="btn btn-ghost btn-lg">
                <PhoneIcon class="size-5" /> Call {{ site.phone }}
            </a>
        </div>
    </PageHero>

    <section class="section">
        <div class="wrap grid gap-14 lg:grid-cols-[1.6fr_1fr]">
            <div class="rounded-3xl border border-line bg-white p-6 sm:p-9">
                <h2 class="text-2xl">Send us a message</h2>
                <p class="mb-7 mt-1 text-body">Only your name and phone number are needed.</p>
                <ContactForm />
            </div>

            <aside class="h-fit rounded-3xl border border-line bg-surface p-7 sm:p-8">
                <h2 class="text-2xl">Our details</h2>
                <dl class="mt-6 space-y-5">
                    <div>
                        <dt class="text-sm font-semibold text-muted">Phone and WhatsApp</dt>
                        <dd><a :href="phoneLink()" class="link">{{ site.phone }}</a></dd>
                    </div>
                    <div v-if="site.email">
                        <dt class="text-sm font-semibold text-muted">Email</dt>
                        <dd><a :href="`mailto:${site.email}`" class="link">{{ site.email }}</a></dd>
                    </div>
                    <div>
                        <dt class="text-sm font-semibold text-muted">Office</dt>
                        <dd class="text-ink">{{ site.address }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-semibold text-muted">Timings</dt>
                        <dd class="text-ink">{{ site.hours }}</dd>
                    </div>
                </dl>
            </aside>
        </div>
    </section>
</template>
