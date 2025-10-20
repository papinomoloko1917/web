<template>

    <Head title="Галерея Вкуса - Проект" />

    <section class="pt-5 lg:pt-20">
        <div class="container-custom">
            <!-- Хлебные крошки -->
            <nav class="flex mb-8" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <Link href="/"
                            class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                        Главная
                        </Link>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-3 h-3 mx-1 text-gray-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg>
                            <Link href="/projects"
                                class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2">
                            Проекты
                            </Link>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-3 h-3 mx-1 text-gray-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg>
                            <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Галерея Вкуса</span>
                        </div>
                    </li>
                </ol>
            </nav>

            <!-- Заголовок проекта -->
            <div class="mb-12">
                <h1 data-reveal data-delay="0"
                    class="font-montserrat text-3xl md:text-5xl lg:text-6xl font-extrabold tracking-tight text-gray-900 mb-6">
                    ГАЛЕРЕЯ ВКУСА
                </h1>
                <p data-reveal data-delay="100" class="text-lg lg:text-xl text-slate-700 max-w-4xl">
                    Современная пекарня, кондитерская и кафе в Краснодарском крае. Комплексное решение по
                    электроснабжению,
                    проектированию сетей, видеонаблюдению и пожарной автоматике.
                </p>
            </div>

            <!-- Услуги по проекту -->
            <div data-reveal data-delay="150" class="mb-12">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-6">Выполненные работы</h2>
                <div class="flex flex-wrap gap-3">
                    <span v-for="service in services" :key="service"
                        class="bg-blue-100 text-blue-800 text-sm md:text-base font-medium px-4 py-2 rounded-full border border-blue-200">
                        {{ service }}
                    </span>
                </div>
            </div>

            <!-- Основное изображение -->
            <div data-reveal data-delay="200" class="mb-12">
                <img :src="projectImages.main" alt="Галерея Вкуса - фасад здания"
                    class="w-full h-auto rounded-lg shadow-xl" loading="eager">
            </div>

            <!-- Сравнение: Проект vs Реализация -->
            <div data-reveal data-delay="225" class="mb-12">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-6">Проект и Реализация</h2>
                <p class="text-slate-700 mb-6">
                    Сравните проектное решение освещения фасада с финальной реализацией.
                    Перетащите разделитель, чтобы увидеть различия.
                </p>
                <div class="w-full h-[400px] md:h-[500px] lg:h-[600px]">
                    <ImageComparisonSlider :image-before="projectImages.gallery[1]" :image-after="projectImages.main"
                        alt-before="Проектное решение освещения" alt-after="Реализованный фасад" label-before="Проект"
                        label-after="Реализация" :initial-position="50" />
                </div>
            </div>

            <!-- Описание проекта -->
            <div data-reveal data-delay="250" class="prose prose-lg max-w-none mb-12">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-6">О проекте</h2>
                <div class="space-y-4 text-slate-700">
                    <p>
                        Проект "Галерея Вкуса" представляет собой современный многофункциональный комплекс,
                        объединяющий пекарню, кондитерскую и кафе. Мы выполнили полный комплекс работ по
                        инженерному обеспечению объекта.
                    </p>
                    <p>
                        В рамках проекта были реализованы следующие системы:
                    </p>
                    <ul class="list-disc pl-6 space-y-2">
                        <li>Электромонтажные работы и электроснабжение всего комплекса</li>
                        <li>Проектирование и монтаж локальных компьютерных сетей</li>
                        <li>Установка системы интернет-связи для бизнес-процессов</li>
                        <li>Монтаж системы видеонаблюдения для контроля безопасности</li>
                        <li>Установка пожарной автоматики и систем безопасности</li>
                    </ul>
                    <p>
                        Все работы были выполнены в соответствии с современными стандартами и требованиями
                        безопасности. Объект успешно функционирует и обслуживает клиентов.
                    </p>
                </div>
            </div>

            <!-- Дополнительные изображения -->
            <div data-reveal data-delay="300" class="mb-16">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-6">Галерея проекта</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <img :src="projectImages.gallery[0]" alt="Галерея Вкуса - вид 1"
                        class="w-full h-auto rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300"
                        loading="lazy">
                    <img :src="projectImages.gallery[1]" alt="Галерея Вкуса - проект освещения"
                        class="w-full h-auto rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300"
                        loading="lazy">
                </div>
            </div>

            <!-- Характеристики проекта -->
            <div data-reveal data-delay="350" class="bg-gray-50 rounded-lg p-8 mb-16">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-6">Характеристики</h2>
                <dl class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <dt class="text-sm font-medium text-gray-500 mb-2">Тип объекта</dt>
                        <dd class="text-lg font-semibold text-gray-900">Коммерческое здание</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500 mb-2">Назначение</dt>
                        <dd class="text-lg font-semibold text-gray-900">Пекарня, кондитерская, кафе</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500 mb-2">Срок реализации</dt>
                        <dd class="text-lg font-semibold text-gray-900">3 месяца</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500 mb-2">Статус</dt>
                        <dd class="text-lg font-semibold text-green-600">Завершен и функционирует</dd>
                    </div>
                </dl>
            </div>

            <!-- Кнопка возврата -->
            <div data-reveal data-delay="400" class="text-center mb-16">
                <Link href="/projects"
                    class="inline-flex items-center px-8 py-3 text-lg font-semibold text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition-colors duration-300 shadow-md hover:shadow-lg">
                <svg class="w-5 h-5 mr-2 rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 7l5 5m0 0l-5 5m5-5H6" />
                </svg>
                Вернуться к проектам
                </Link>
            </div>
        </div>
    </section>
</template>

<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { onMounted } from 'vue';
import ImageComparisonSlider from './Partials_GalleryOfTaste/ImageComparisonSlider.vue';

const services = [
    'Электромонтаж',
    'Проектирование',
    'Интернет',
    'Видеонаблюдение',
    'Пожарная автоматика'
];

const projectImages = {
    main: '/images/our_projects/pekarnya/fasade_large.jpg',
    gallery: [
        '/images/our_projects/pekarnya/facade.jpg',
        '/images/our_projects/pekarnya/fasade_dialux.jpg'
    ]
};

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
