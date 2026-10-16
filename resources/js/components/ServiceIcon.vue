<script setup>
defineProps({ name: { type: String, required: true } });

// 24×24 stroke icons. Add a new key here when you add a service with a new icon.
const paths = {
    code: 'M8 8l-4 4 4 4M16 8l4 4-4 4M13.5 5l-3 14',
    wordpress: 'M12 3a9 9 0 100 18 9 9 0 000-18zM4.5 9l4 10M9 9l3.5 9.5L15.5 9M19.5 9l-3.2 9M7 9h4M13.5 9h4',
    phone: 'M8 3h8a1 1 0 011 1v16a1 1 0 01-1 1H8a1 1 0 01-1-1V4a1 1 0 011-1zM11 18h2',
    layout: 'M4 5h16v14H4zM4 9.5h16M9.5 9.5V19',
    cursor: 'M5 4l5.5 15 2.2-6.3L19 10.5zM14 14l5 5',
    pen: 'M4 20l1-4.5L15.5 5l3.5 3.5L8.5 19zM13.5 7l3.5 3.5',
    search: 'M10.5 4a6.5 6.5 0 100 13 6.5 6.5 0 000-13zM15.5 15.5L20 20',
    megaphone: 'M4 10v4h3l8 4V6l-8 4zM18 9.5a3.5 3.5 0 010 5M8 14.5l1 4.5h2.5',
    document: 'M7 3h7l4 4v14H7zM14 3v4h4M10 12h5M10 16h5',
    chart: 'M4 20V4M4 20h16M8 16v-4M12 16V8M16 16v-6',
    school: 'M3 9l9-5 9 5-9 5zM7 11.2V16c0 1.5 2.2 3 5 3s5-1.5 5-3v-4.8M21 9v6',
    video: 'M4 6h11v12H4zM15 10.5l5-3v9l-5-3',
    pharmacy: 'M9 3h6v6h6v6h-6v6H9v-6H3V9h6z',
    restaurant: 'M7 3v18M4.5 3v5a2.5 2.5 0 005 0V3M17 3c-2.2 1.2-3 4-3 7h3v11',
    home: 'M3 11l9-7 9 7M5 9.5V20h14V9.5M10 20v-6h4v6',
    car: 'M3 13l2-6h14l2 6v5h-3M6 18H3v-5h18M7 18a1.5 1.5 0 103 0 1.5 1.5 0 00-3 0M14 18a1.5 1.5 0 103 0 1.5 1.5 0 00-3 0',
    bag: 'M5 8h14l-1 13H6zM9 8V6a3 3 0 016 0v2',
    shop: 'M4 9l1.5-5h13L20 9M4 9h16v11H4zM10 20v-6h4v6',
};
</script>

<template>
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
        <path :d="paths[name] ?? paths.code" />
    </svg>
</template>
