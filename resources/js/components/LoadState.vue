<script setup>
import { content, loadContent } from '../lib/api';

// Shows the default slot once content is loaded; otherwise a loading or retry message.
defineProps({ what: { type: String, required: true } });
</script>

<template>
    <slot v-if="content.ready" />
    <div v-else-if="content.failed" class="rounded-2xl border border-line bg-surface p-6 text-body" role="alert">
        <p class="font-semibold text-ink">The {{ what }} did not load.</p>
        <p class="mt-1">Check your connection, then try again.</p>
        <button type="button" class="btn btn-outline mt-4" @click="content.failed = false; loadContent()">Try again</button>
    </div>
    <p v-else class="text-muted" aria-live="polite">Loading {{ what }}…</p>
</template>
