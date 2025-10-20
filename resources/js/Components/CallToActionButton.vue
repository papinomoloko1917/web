<template>
    <a :href="href"
        class="cta-button font-montserrat w-full sm:w-auto inline-flex items-center justify-center px-7 lg:px-8 py-3 bg-blue-600 text-white text-xl font-semibold shadow focus:outline-none focus:ring-2 focus:ring-blue-500"
        :aria-label="ariaLabel">
        {{ text }}
    </a>
</template>

<script setup>
defineProps({
    text: {
        type: String,
        default: 'Связаться с нами'
    },
    href: {
        type: String,
        default: 'tel:+79282547147'
    },
    ariaLabel: {
        type: String,
        default: 'Позвонить для расчета проекта'
    }
});
</script>

<style scoped>
.cta-button {
    border-radius: 2rem;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.cta-button:hover {
    border-radius: 0;
    background-color: #1d4ed8;
    /* blue-700 */
    transform: translateY(-1px);
    box-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
}

.cta-button:active {
    transform: translateY(0);
}
</style>
