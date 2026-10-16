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

const budgets = ['Under Rs 15,000', 'Rs 15,000 – 30,000', 'Rs 30,000 – 50,000', 'Above Rs 50,000', 'Not sure yet'];

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
        <h2 class="text-2xl">Thank you, {{ form.name }}!</h2>
        <p class="mt-2 text-body">We got your message. We will call or WhatsApp you on <strong>{{ form.phone }}</strong> within one working day.</p>
        <button type="button" class="btn btn-outline mt-6" @click="reset">Send another message</button>
    </div>

    <form v-else class="space-y-6" novalidate @submit.prevent="submit">
        <p v-if="form.plan" class="flex flex-wrap items-center gap-x-3 gap-y-1 rounded-lg bg-accent-soft px-4 py-3 text-accent-strong">
            <span>Package: <strong>{{ form.plan }}</strong></span>
            <button type="button" class="link cursor-pointer text-sm" @click="form.plan = ''">Remove</button>
        </p>

        <div class="grid gap-6 sm:grid-cols-2">
            <div>
                <label for="name" class="field-label">Your name</label>
                <input id="name" v-model.trim="form.name" type="text" autocomplete="name" class="field" :aria-invalid="!!errors.name" />
                <p v-if="errors.name" class="field-error">{{ errors.name[0] }}</p>
            </div>
            <div>
                <label for="phone" class="field-label">Phone or WhatsApp number</label>
                <input id="phone" v-model.trim="form.phone" type="tel" inputmode="tel" autocomplete="tel" placeholder="0300 1234567" class="field" :aria-invalid="!!errors.phone" />
                <p v-if="errors.phone" class="field-error">{{ errors.phone[0] }}</p>
            </div>
            <div>
                <label for="budget" class="field-label">Budget <span class="font-normal text-muted">(optional)</span></label>
                <select id="budget" v-model="form.budget" class="field">
                    <option value="">Choose your budget</option>
                    <option v-for="budget in budgets" :key="budget">{{ budget }}</option>
                </select>
            </div>
        </div>

        <fieldset>
            <legend class="field-label">What do you need? <span class="font-normal text-muted">(optional)</span></legend>
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
            <label for="message" class="field-label">Your message <span class="font-normal text-muted">(optional)</span></label>
            <textarea id="message" v-model.trim="form.message" rows="4" class="field" placeholder="For example: I need a website for my school. We have 3 campuses." :aria-invalid="!!errors.message"></textarea>
            <p v-if="errors.message" class="field-error">{{ errors.message[0] }}</p>
        </div>

        <p v-if="status === 'failed'" class="rounded-lg bg-red-50 px-4 py-3 font-medium text-red-800" role="alert">
            Your message was not sent. Please check your internet and try again, or message us on WhatsApp.
        </p>

        <button type="submit" class="btn btn-primary btn-lg w-full disabled:opacity-60 sm:w-auto" :disabled="status === 'sending'">
            {{ status === 'sending' ? 'Sending…' : 'Send message' }}
        </button>
    </form>
</template>
