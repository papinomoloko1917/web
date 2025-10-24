<template>
    <section class="photo-gallery-section section-divider-bottom" style="background: #161617;">
        <div class="container-custom py-12 lg:py-20">
            <div data-reveal data-delay="300">
                <h2 class="font-montserrat text-3xl md:text-4xl lg:text-4xl font-extrabold text-gray-200 mb-6">
                    ФОТОГАЛЕРЕЯ ПРОЕКТА</h2>
                <p class="text-gray-400 mb-8">
                    Посмотрите на реализованные системы и оснащение объекта
                </p>

                <!-- Компонент карусели с фотогалереей -->
                <PhotoGalleryCarousel :images="photos" />
            </div>
        </div>
    </section>
</template>

<script setup>
import PhotoGalleryCarousel from '../../Portfolio/Partials_GalleryOfTaste/PhotoGalleryCarousel.vue';

defineProps({
    photos: {
        type: Array,
        required: true
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
</style>
