<script setup>
import ChatIcon from './ChatIcon.vue';
import { whatsappLink } from '../lib/site';
</script>

<template>
    <!-- Always-visible WhatsApp button, bottom right on every page -->
    <a
        :href="whatsappLink()"
        target="_blank"
        rel="noopener"
        class="fixed bottom-5 right-5 z-50 flex items-center gap-2 rounded-full bg-[#128c45] px-4 py-3.5 font-bold text-white shadow-[0_12px_30px_-8px_rgba(0,0,0,0.45)] transition-transform hover:scale-105 hover:bg-[#0e7038]"
    >
        <ChatIcon class="size-6" />
        <span class="hidden sm:inline">WhatsApp us</span>
        <span class="sr-only sm:hidden">Chat with us on WhatsApp</span>
    </a>
</template>
