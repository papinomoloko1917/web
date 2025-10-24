<template>

    <Head title="МБОУ СОШ №1 - Проект" />

    <HeroSection :main-image="projectImages.main" :services="services" />

    <AboutProjectSection />

    <PhotoGallerySection :images="galleryImages" />

    <Connection />

    <Map />

</template>

<script setup>
import { Head } from '@inertiajs/vue3';
import { onMounted } from 'vue';
import HeroSection from './Partials_SOSH_1/HeroSection.vue';
import AboutProjectSection from './Partials_SOSH_1/AboutProjectSection.vue';
import PhotoGallerySection from './Partials_SOSH_1/PhotoGallerySection.vue';
import Connection from '../MainSections/Connection.vue';
import Map from '../MainSections/Map.vue';

const services = [
    'Проектирование',
    'Электромонтаж',
    'Интернет',
    'Видеонаблюдение',
    'Пожарная автоматика',
    'Система оповещения'
];

const projectImages = {
    main: '/images/our_projects/SOSH_1/1.jpg',
    gallery: [
        '/images/our_projects/SOSH_1/2.jpg',
        '/images/our_projects/SOSH_1/3.jpg'
    ]
};

const galleryImages = [
    { src: '/images/our_projects/SOSH_1/2.jpg', alt: 'МБОУ СОШ №1 - фото 2' },
    { src: '/images/our_projects/SOSH_1/3.jpg', alt: 'МБОУ СОШ №1 - фото 3' },
    { src: '/images/our_projects/SOSH_1/4.jpg', alt: 'МБОУ СОШ №1 - фото 4' },
    { src: '/images/our_projects/SOSH_1/5.jpg', alt: 'МБОУ СОШ №1 - фото 5' },
    { src: '/images/our_projects/SOSH_1/6.jpg', alt: 'МБОУ СОШ №1 - фото 6' },
    { src: '/images/our_projects/SOSH_1/7.jpg', alt: 'МБОУ СОШ №1 - фото 7' },
    { src: '/images/our_projects/SOSH_1/8.jpg', alt: 'МБОУ СОШ №1 - фото 8' },
    { src: '/images/our_projects/SOSH_1/9.jpg', alt: 'МБОУ СОШ №1 - фото 9' }
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
