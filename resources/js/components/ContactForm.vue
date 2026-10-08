<script setup>
import { reactive, ref } from 'vue';
import { useRoute } from 'vue-router';
import { content, sendContactMessage } from '../lib/api';

const route = useRoute();

const blank = () => ({
    name: '',
    email: '',
    phone: '',
    services: route.query.services ? String(route.query.services).split(',') : [],
    plan: route.query.plan ? String(route.query.plan) : '',
    budget: '',
    message: '',
});

const form = reactive(blank());
const errors = ref({});
const status = ref('idle'); // idle | sending | sent | failed

const budgets = ['Under $500', '$500 – $1,500', '$1,500 – $5,000', 'Over $5,000', 'Not sure yet'];

async function submit() {
    status.value = 'sending';
    errors.value = {};
    try {
        await sendContactMessage(form);
        status.value = 'sent';
    } catch (error) {
        if (error.status === 422) {
            errors.value = error.errors;
            status.value = 'idle';
        } else {
            status.value = 'failed';
        }
    }
}

function reset() {
    Object.assign(form, blank(), { services: [], plan: '' });
    status.value = 'idle';
}
</script>

<template>
    <div v-if="status === 'sent'" class="rounded-2xl bg-accent-soft p-8" role="status">
        <h2 class="text-2xl">Message sent</h2>
        <p class="mt-2 text-body">Thanks, {{ form.name }}. We will reply to {{ form.email }} within one working day.</p>
        <button type="button" class="btn btn-outline mt-6" @click="reset">Send another message</button>
    </div>

    <form v-else class="space-y-6" novalidate @submit.prevent="submit">
        <p v-if="form.plan" class="flex flex-wrap items-center gap-x-3 gap-y-1 rounded-lg bg-accent-soft px-4 py-3 text-accent-strong">
            <span>Plan: <strong>{{ form.plan }}</strong></span>
            <button type="button" class="link cursor-pointer text-sm" @click="form.plan = ''">Remove</button>
        </p>

        <div class="grid gap-6 sm:grid-cols-2">
            <div>
                <label for="name" class="field-label">Your name</label>
                <input id="name" v-model.trim="form.name" type="text" autocomplete="name" class="field" :aria-invalid="!!errors.name" />
                <p v-if="errors.name" class="field-error">{{ errors.name[0] }}</p>
            </div>
            <div>
                <label for="email" class="field-label">Email</label>
                <input id="email" v-model.trim="form.email" type="email" autocomplete="email" class="field" :aria-invalid="!!errors.email" />
                <p v-if="errors.email" class="field-error">{{ errors.email[0] }}</p>
            </div>
            <div>
                <label for="phone" class="field-label">Phone or WhatsApp <span class="font-normal text-muted">(optional)</span></label>
                <input id="phone" v-model.trim="form.phone" type="tel" autocomplete="tel" class="field" />
                <p v-if="errors.phone" class="field-error">{{ errors.phone[0] }}</p>
            </div>
            <div>
                <label for="budget" class="field-label">Budget <span class="font-normal text-muted">(optional)</span></label>
                <select id="budget" v-model="form.budget" class="field">
                    <option value="">Choose a range</option>
                    <option v-for="budget in budgets" :key="budget">{{ budget }}</option>
                </select>
            </div>
        </div>

        <fieldset>
            <legend class="field-label">Which services do you need? <span class="font-normal text-muted">(optional)</span></legend>
            <div class="flex flex-wrap gap-2">
                <label
                    v-for="service in content.services"
                    :key="service.slug"
                    class="cursor-pointer rounded-full border px-3.5 py-2 text-[0.95rem] font-medium transition-colors has-[:focus-visible]:outline-3 has-[:focus-visible]:outline-accent"
                    :class="form.services.includes(service.slug) ? 'border-accent bg-accent text-white' : 'border-line bg-white text-body hover:border-accent hover:bg-accent-soft'"
                >
                    <input v-model="form.services" type="checkbox" :value="service.slug" class="sr-only" />
                    {{ service.title }}
                </label>
            </div>
        </fieldset>

        <div>
            <label for="message" class="field-label">About your project</label>
            <textarea id="message" v-model.trim="form.message" rows="5" class="field" placeholder="What you want to build, who it is for, and when you need it." :aria-invalid="!!errors.message"></textarea>
            <p v-if="errors.message" class="field-error">{{ errors.message[0] }}</p>
        </div>

        <p v-if="status === 'failed'" class="rounded-lg bg-red-50 px-4 py-3 font-medium text-red-800" role="alert">
            Your message was not sent. Check your connection and send it again, or message us on WhatsApp.
        </p>

        <button type="submit" class="btn btn-primary disabled:opacity-60" :disabled="status === 'sending'">
            {{ status === 'sending' ? 'Sending…' : 'Send message' }}
        </button>
    </form>
</template>
