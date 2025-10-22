<template>

    <Head title="Галерея Вкуса - Проект" />

    <HeroSection :main-image="projectImages.main" :services="services" />

    <AboutProjectSection />

    <PhotoGallerySection :images="galleryImages" />

    <ArchitecturalLightingSection :image-before="projectImages.gallery[1]" :image-after="projectImages.main" />

    <Connection />

    <Map />

</template>

<script setup>
import { Head } from '@inertiajs/vue3';
import { onMounted } from 'vue';
import HeroSection from './Partials_GalleryOfTaste/HeroSection.vue';
import ArchitecturalLightingSection from './Partials_GalleryOfTaste/ArchitecturalLightingSection.vue';
import AboutProjectSection from './Partials_GalleryOfTaste/AboutProjectSection.vue';
import PhotoGallerySection from './Partials_GalleryOfTaste/PhotoGallerySection.vue';
import Connection from '../MainSections/Connection.vue';
import Map from '../MainSections/Map.vue';

const services = [
    'Электромонтаж',
    'Проектирование',
    'Интернет',
    'Видеонаблюдение',
    'Архитектурное освещение',
    'Пожарная автоматика'
];

const projectImages = {
    main: '/images/our_projects/pekarnya/fasade_large.jpg',
    gallery: [
        '/images/our_projects/pekarnya/facade.jpg',
        '/images/our_projects/pekarnya/fasade_dialux.jpg'
    ]
};

const galleryImages = [
    { src: '/images/our_projects/pekarnya/img/зал.jpg', alt: 'Интерьер кафе - основной зал' },
    { src: '/images/our_projects/pekarnya/img/зал-2.jpg', alt: 'Интерьер кафе - дополнительная зона' },
    { src: '/images/our_projects/pekarnya/img/Хлеб.jpg', alt: 'Витрина с хлебобулочными изделиями' },
    { src: '/images/our_projects/pekarnya/img/Камера.jpg', alt: 'Система видеонаблюдения' },
    { src: '/images/our_projects/pekarnya/img/Сервер.jpg', alt: 'Серверное оборудование' },
    { src: '/images/our_projects/pekarnya/img/СПС.jpg', alt: 'Система пожарной сигнализации' },
    { src: '/images/our_projects/pekarnya/img/АПС.jpg', alt: 'Автоматическая пожарная сигнализация' }
];

onMounted(() => {
    initRevealAnimation();
});

function initRevealAnimation() {
    const nodes = Array.from(document.querySelectorAll('[data-reveal]'));
    if (!nodes.length) return;

    const reduce = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    if (!reduce) {
        nodes.forEach(el => el.classList.add('reveal-init'));
    }

    const reveal = (el) => {
        const delay = parseInt(el.getAttribute('data-delay') || '0', 10);

        if (reduce) {
            el.classList.remove('reveal-init');
            el.classList.add('reveal-in');
            return;
        }

        el.style.transitionDelay = delay + 'ms';
        requestAnimationFrame(() => {
            el.classList.add('reveal-in');
            el.classList.remove('reveal-init');
        });
    };

    const viewportH = window.innerHeight || document.documentElement.clientHeight;
    nodes.forEach(el => {
        const r = el.getBoundingClientRect();
        if (r.top < viewportH * 0.85) reveal(el);
    });

    if (reduce) return;

    const io = new IntersectionObserver((entries, obs) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                reveal(entry.target);
                obs.unobserve(entry.target);
            }
        });
    }, { threshold: 0.15 });

    nodes.forEach(el => {
        if (!el.classList.contains('reveal-in')) io.observe(el);
    });
}
</script>

<style scoped>
[data-reveal] {
    will-change: transform, opacity, filter;
    transition: opacity 500ms cubic-bezier(.25, .65, .25, 1),
        transform 500ms cubic-bezier(.25, .65, .25, 1),
        filter 520ms cubic-bezier(.25, .65, .25, 1);
}

[data-reveal].reveal-init {
    opacity: 0;
    transform: translateY(16px) scale(.985);
    filter: blur(2px) saturate(.9);
}

[data-reveal].reveal-in {
    opacity: 1;
    transform: translateY(0) scale(1);
    filter: blur(0) saturate(1);
}

@media (prefers-reduced-motion: reduce) {
    [data-reveal] {
        transition: none !important;
    }

    [data-reveal].reveal-init {
        opacity: 1 !important;
        transform: none !important;
        filter: none !important;
    }
}
</style>
