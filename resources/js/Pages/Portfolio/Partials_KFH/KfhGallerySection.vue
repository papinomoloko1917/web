<template>
    <section class="photo-gallery-section py-16 md:py-24 lg:py-32 relative" style="background-color: #060604;">
        <div class="container-custom">
            <!-- Заголовок секции -->
            <div data-reveal data-delay="200" class="mb-12 md:mb-16 text-center">
                <h2
                    class="font-montserrat text-3xl md:text-4xl lg:text-5xl font-bold tracking-tight mb-6 text-gray-100">
                    Фотогалерея
                </h2>
                <p class="text-base md:text-lg text-gray-300 max-w-2xl mx-auto">
                    Визуальный обзор реализованного проекта
                </p>
            </div>

            <!-- Карусель фотографий -->
            <div data-reveal data-delay="400">
                <PhotoGalleryCarousel :images="photos" />
            </div>
        </div>

        <!-- Кнопка возврата к проектам -->
        <div data-reveal data-delay="600" class="container-custom mt-16 md:mt-20 lg:mt-24">
            <div class="flex justify-center">
                <Link href="/projects"
                    class="return-button inline-flex items-center px-8 py-4 text-base md:text-lg font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 group">
                <svg class="w-5 h-5 mr-2 transform group-hover:-translate-x-1 transition-transform duration-300"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Вернуться к проектам
                </Link>
            </div>
        </div>
    </section>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import PhotoGalleryCarousel from '../../Portfolio/Partials_GalleryOfTaste/PhotoGalleryCarousel.vue';

defineProps({
    photos: {
        type: Array,
        required: true
    }
});
</script>

<style scoped>
.return-button {
    border-radius: 16px;
    transition: all 0.3s ease;
}

.return-button:hover {
    border-radius: 24px;
}
</style>
