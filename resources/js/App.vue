<script setup>
import { onMounted } from 'vue';
import SiteHeader from './components/SiteHeader.vue';
import SiteFooter from './components/SiteFooter.vue';
import WhatsAppFloat from './components/WhatsAppFloat.vue';
import { loadContent } from './lib/api';

onMounted(loadContent);
</script>

<template>
    <a href="#main" class="sr-only focus:not-sr-only focus:absolute focus:left-4 focus:top-4 focus:z-50 focus:rounded-lg focus:bg-paper focus:px-4 focus:py-2">
        Skip to content
    </a>
    <SiteHeader />
    <main id="main" class="min-h-screen">
        <RouterView v-slot="{ Component, route }">
            <Transition name="page">
                <component :is="Component" :key="route.path" />
            </Transition>
        </RouterView>
    </main>
    <SiteFooter />
    <WhatsAppFloat />
</template>
