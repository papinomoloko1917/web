<template>
    <a :href="`tel:${tel}`" aria-label="Позвонить"
        class="header-telephone font-semibold hidden lg:flex items-center gap-0 rounded-4xl overflow-hidden px-3 py-2 cursor-pointer transition-all duration-400 hover:rounded-none"
        :class="expanded ? 'bg-gray-300 text-gray-800' : 'bg-blue-600 text-gray-200'">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
            class="size-6 no-invert" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M10.5 1.5H8.25A2.25 2.25 0 0 0 6 3.75v16.5a2.25 2.25 0 0 0 2.25 2.25h7.5A2.25 2.25 0 0 0 18 20.25V3.75a2.25 2.25 0 0 0-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3" />
        </svg>
        <span class="font-montserrat inline-block px-2 py-0.5 text-lg leading-none">{{ phone }}</span>
    </a>
</template>

<script setup>
const props = defineProps({
    expanded: { type: Boolean, default: false },
    phone: { type: String, default: '+7 (918) 254 71 47' },
    tel: { type: String, default: '+79182547147' },
})
</script>

<style scoped></style>
