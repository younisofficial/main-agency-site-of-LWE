<script setup>
// Light title band at the top of inner pages.
defineProps({
    title: { type: String, required: true },
    text: { type: String, default: '' },
});
</script>

<template>
    <section class="band-light overflow-hidden">
        <div class="wrap py-14 sm:py-20">
            <h1 v-reveal="'down'" class="max-w-4xl text-4xl font-extrabold sm:text-6xl">{{ title }}</h1>
            <p v-if="text" v-reveal="{ dir: 'up', delay: 120 }" class="mt-5 max-w-2xl text-lg text-body">{{ text }}</p>
            <slot />
        </div>
    </section>
</template>
