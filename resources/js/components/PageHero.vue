<script setup>
// Dark title band at the top of inner pages.
defineProps({
    title: { type: String, required: true },
    text: { type: String, default: '' },
});
</script>

<template>
    <section class="band-night">
        <div class="wrap py-16 sm:py-20">
            <h1 class="max-w-4xl text-4xl font-extrabold sm:text-6xl">{{ title }}</h1>
            <p v-if="text" class="mt-5 max-w-2xl text-lg text-white/75">{{ text }}</p>
            <slot />
        </div>
    </section>
</template>
