<template>
    <section class="photo-gallery-section" style="background: #161617;">
        <div class="container-custom py-12 lg:py-20">
            <div data-reveal data-delay="300">
                <h2 class="font-montserrat text-3xl md:text-4xl lg:text-4xl font-extrabold text-gray-200 mb-6">
                    ФОТОГАЛЕРЕЯ ПРОЕКТА</h2>
                <p class="text-gray-400 mb-8">
                    Посмотрите на реализованные системы и внутреннее оснащение объекта
                </p>

                <!-- Компонент карусели с фотогалереей -->
                <PhotoGalleryCarousel :images="images" />
            </div>
        </div>

        <!-- Кнопка возврата -->
        <div class="container-custom pt-12 lg:pt-16 pb-12 lg:pb-20">
            <div data-reveal data-delay="400" class="text-center">
                <Link href="/projects"
                    class="return-button rounded-4xl inline-flex items-center px-8 py-3 text-lg font-semibold text-white bg-gray-500/30 hover:bg-gray-400/30 transition-all duration-300 shadow-md hover:shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="mr-2 lucide lucide-undo2-icon lucide-undo-2">
                    <path d="M9 14 4 9l5-5" />
                    <path d="M4 9h10.5a5.5 5.5 0 0 1 5.5 5.5a5.5 5.5 0 0 1-5.5 5.5H11" />
                </svg>
                Вернуться к проектам
                </Link>
            </div>
        </div>
    </section>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import PhotoGalleryCarousel from './PhotoGalleryCarousel.vue';

defineProps({
    images: {
        type: Array,
        required: true,
        default: () => []
    }
});
</script>

<style scoped>
.photo-gallery-section {
    position: relative;
}

/* Стиль кнопки возврата */
.return-button {
    transition: border-radius 420ms cubic-bezier(.2, .7, .2, 1),
        background-color 300ms cubic-bezier(.2, .7, .2, 1),
        box-shadow 300ms cubic-bezier(.2, .7, .2, 1);
}

.return-button:hover {
    border-radius: 0;
}
</style>
