<template>
    <section class="pt-5 lg:pt-20 lg:pb-5">
        <div class="container-custom">
            <h1 data-reveal data-delay="0"
                class="text-center font-montserrat text-3xl md:text-5xl lg:text-6xl font-extrabold tracking-tight text-gray-900 mb-6">
                РЕАЛИЗОВАННЫЕ ПРОЕКТЫ
            </h1>
            <p data-reveal data-delay="100"
                class="text-center max-w-4xl mx-auto text-slate-700 text-lg lg:text-2xl leading-relaxed">
                За годы работы мы успешно реализовали более 500 проектов по всему Краснодарскому краю. Ознакомьтесь с
                некоторыми из наших работ.
            </p>
        </div>
    </section>
</template>

<script setup>
import { onMounted } from 'vue';

onMounted(() => {
    // Reveal-эффект при скролле
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
