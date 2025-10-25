<template>

    <Head title="Dynasty - Проект" />

    <HeroSection :main-image="projectImages.main" :services="services" />

    <AboutProjectSection />

    <PhotoGallerySection :images="galleryImages" />

    <Connection />

    <Map />

</template>

<script setup>
import { Head } from '@inertiajs/vue3';
import { onMounted } from 'vue';
import HeroSection from './Partials_Dynasty/HeroSection.vue';
import AboutProjectSection from './Partials_Dynasty/AboutProjectSection.vue';
import PhotoGallerySection from '../../Components/PhotoGallerySection.vue';
import Connection from '../MainSections/Connection.vue';
import Map from '../MainSections/Map.vue';

const services = [
    'Проектирование',
    'Электромонтаж',
    'Интернет',
    'Видеонаблюдение',
    'Архитектурное освещение',
    'Пожарная автоматика'
];

const projectImages = {
    main: '/images/our_projects/caplya/1.jpg',
    gallery: [
        '/images/our_projects/caplya/2.jpg',
        '/images/our_projects/caplya/3.jpg'
    ]
};

const galleryImages = [
    { src: '/images/our_projects/caplya/2.jpg', alt: 'Dynasty - фото 2' },
    { src: '/images/our_projects/caplya/3.jpg', alt: 'Dynasty - фото 3' },
    { src: '/images/our_projects/caplya/4.jpg', alt: 'Dynasty - фото 4' },
    { src: '/images/our_projects/caplya/5.jpg', alt: 'Dynasty - фото 5' },
    { src: '/images/our_projects/caplya/6.jpg', alt: 'Dynasty - фото 6' },
    { src: '/images/our_projects/caplya/7.jpg', alt: 'Dynasty - фото 7' },
    { src: '/images/our_projects/caplya/8.jpg', alt: 'Dynasty - фото 8' },
    { src: '/images/our_projects/caplya/9.jpg', alt: 'Dynasty - фото 9' },
    { src: '/images/our_projects/caplya/10.jpg', alt: 'Dynasty - фото 10' },
    { src: '/images/our_projects/caplya/11.jpg', alt: 'Dynasty - фото 11' },
    { src: '/images/our_projects/caplya/12.jpg', alt: 'Dynasty - фото 12' },
    { src: '/images/our_projects/caplya/13.jpg', alt: 'Dynasty - фото 13' },
    { src: '/images/our_projects/caplya/14.jpg', alt: 'Dynasty - фото 14' }

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
