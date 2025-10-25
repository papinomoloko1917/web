<template>
    <section class="photo-gallery-section" :class="{ 'section-divider-bottom': showDivider }"
        style="background: #161617;">
        <div class="container-custom py-12 lg:py-20">
            <div data-reveal data-delay="300">
                <h2 class="font-montserrat text-3xl md:text-4xl lg:text-4xl font-extrabold text-gray-200 mb-6">
                    {{ title }}</h2>
                <p class="text-gray-400 mb-8">
                    {{ description }}
                </p>

                <!-- Компонент карусели с фотогалереей -->
                <PhotoGalleryCarousel :images="images" />
            </div>
        </div>

        <!-- Кнопка возврата (опциональная) -->
        <div v-if="showReturnButton" class="container-custom pt-0 lg:pt-0 pb-12 lg:pb-20">
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
import PhotoGalleryCarousel from '../Pages/Portfolio/Partials_Dynasty/PhotoGalleryCarousel.vue';

defineProps({
    title: {
        type: String,
        default: 'ФОТОГАЛЕРЕЯ ПРОЕКТА'
    },
    description: {
        type: String,
        default: 'Посмотрите на реализованные системы и оснащение объекта'
    },
    images: {
        type: Array,
        required: true,
        default: () => []
    },
    showReturnButton: {
        type: Boolean,
        default: true
    },
    showDivider: {
        type: Boolean,
        default: false
    }
});
</script>

<style scoped>
.photo-gallery-section {
    position: relative;
}

/* Красивый серый разделитель секций */
.section-divider-bottom {
    position: relative;
    padding-bottom: 0rem;
}

.section-divider-bottom::after {
    content: '';
    position: absolute;
    bottom: 2rem;
    left: 0;
    right: 0;
    width: 100%;
    height: 1px;
    background: linear-gradient(to right,
            transparent 0%,
            rgba(156, 163, 175, 0.15) 10%,
            rgba(156, 163, 175, 0.4) 50%,
            rgba(156, 163, 175, 0.15) 90%,
            transparent 100%);
    pointer-events: none;
}

/* Дополнительная тонкая линия для глубины */
.section-divider-bottom::before {
    content: '';
    position: absolute;
    bottom: calc(2rem + 1px);
    left: 0;
    right: 0;
    width: 100%;
    height: 1px;
    background: linear-gradient(to right,
            transparent 0%,
            rgba(255, 255, 255, 0.03) 10%,
            rgba(255, 255, 255, 0.08) 50%,
            rgba(255, 255, 255, 0.03) 90%,
            transparent 100%);
    pointer-events: none;
}

@media (max-width: 768px) {
    .section-divider-bottom {
        padding-bottom: 3rem;
    }

    .section-divider-bottom::after {
        bottom: 1.5rem;
    }

    .section-divider-bottom::before {
        bottom: calc(1.5rem + 1px);
    }
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
