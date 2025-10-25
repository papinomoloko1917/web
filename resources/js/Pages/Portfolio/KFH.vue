<template>

    <Head title="КФХ - Проект" />

    <KfhHeroSection :main-image="projectData.heroImage" :project-name="projectData.name"
        :project-subtitle="projectData.subtitle" :service-tags="projectData.services" />

    <KfhAboutSection />

    <PhotoGallerySection :images="projectData.galleryPhotos" />

    <Connection />

    <Map />
</template>

<script setup>
import { Head } from '@inertiajs/vue3';
import { onMounted } from 'vue';
import KfhHeroSection from './Partials_KFH/KfhHeroSection.vue';
import KfhAboutSection from './Partials_KFH/KfhAboutSection.vue';
import PhotoGallerySection from '../../Components/PhotoGallerySection.vue';
import Connection from '../MainSections/Connection.vue';
import Map from '../MainSections/Map.vue';

const projectData = {
    name: 'КФХ',
    subtitle: 'Крестьянско-фермерское хозяйство',
    heroImage: '/images/our_projects/kfh_loza/1.jpg',
    services: [
        'Электромонтаж',
        'Проектирование',
        'Локальные сети',
        'Видеонаблюдение'
    ],
    galleryPhotos: [
        { src: '/images/our_projects/kfh_loza/1.jpg', alt: 'КФХ - Общий вид объекта' },
        { src: '/images/our_projects/kfh_loza/2.jpg', alt: 'КФХ - Коммутационный шкаф' },
        { src: '/images/our_projects/kfh_loza/3.jpg', alt: 'КФХ - Wifi-мост, камеры' },
        { src: '/images/our_projects/kfh_loza/4.jpg', alt: 'КФХ - PTZ-камера' },
        { src: '/images/our_projects/kfh_loza/5.jpg', alt: 'КФХ - Готовый объект' }
    ]
};

onMounted(() => {
    setupRevealEffects();
});

function setupRevealEffects() {
    const elements = document.querySelectorAll('[data-reveal]');
    if (!elements.length) return;

    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    if (!prefersReducedMotion) {
        elements.forEach(el => el.classList.add('reveal-init'));
    }

    const showElement = (element) => {
        const delayValue = parseInt(element.getAttribute('data-delay') || '0', 10);

        if (prefersReducedMotion) {
            element.classList.remove('reveal-init');
            element.classList.add('reveal-in');
            return;
        }

        element.style.transitionDelay = delayValue + 'ms';
        requestAnimationFrame(() => {
            element.classList.add('reveal-in');
            element.classList.remove('reveal-init');
        });
    };

    const viewHeight = window.innerHeight || document.documentElement.clientHeight;
    elements.forEach(el => {
        const rect = el.getBoundingClientRect();
        if (rect.top < viewHeight * 0.85) showElement(el);
    });

    if (prefersReducedMotion) return;

    const observer = new IntersectionObserver((entries, obs) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                showElement(entry.target);
                obs.unobserve(entry.target);
            }
        });
    }, { threshold: 0.15 });

    elements.forEach(el => {
        if (!el.classList.contains('reveal-in')) observer.observe(el);
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
