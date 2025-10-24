<template>
    <main>
        <div class="container-custom py-0 pt-10 lg:pt-28">
            <div class="items-start">
                <!-- ЛЕВАЯ КОЛОНКА: текст -->
                <div class="w-full">
                    <h1
                        class="font-montserrat text-4xl md:text-5xl lg:text-6xl font-extrabold tracking-tight text-gray-900">
                        О КОМПАНИИ
                    </h1>
                    <div class="mt-3 lg:mt-25">

                        <h2 id="about-title"
                            class="font-montserrat mt-4  font-bold leading-tight tracking-tight text-slate-900 text-2xl sm:text-4xl lg:text-4xl">
                            Профессиональный подход к электротехническим решениям
                        </h2>

                        <p class="mt-5 max-w-5xl text-slate-900 text-lg lg:text-2xl">
                            Более 14 лет успешной работы на рынке электротехнических услуг позволяют нам уверенно решать
                            задачи
                            любой сложности. Наша компания специализируется на комплексном подходе, включая
                            проектирование,
                            монтаж и обслуживание, обеспечивая надёжность и безопасность каждого проекта.
                        </p>

                        <!-- CTA row -->
                        <div
                            class="mt-8 flex flex-col items-start gap-4 sm:flex-row sm:items-center sm:justify-between">
                            <div
                                class="flex flex-wrap gap-3 py-2 items-center hero-sub transform translate-y-4 opacity-0 transition-all duration-700 ease-out">
                                <CallToActionButton text="Связаться с нами" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>

<script setup>
import { onMounted } from 'vue';
import CallToActionButton from '../../Components/CallToActionButton.vue';

// Анимация появления элементов при загрузке
onMounted(() => {
    const heroSub = document.querySelector('.hero-sub');
    if (heroSub) {
        // Небольшая задержка перед анимацией
        setTimeout(() => {
            heroSub.classList.remove('translate-y-4', 'opacity-0');
            heroSub.classList.add('translate-y-0', 'opacity-100');
        }, 200);
    }
});
</script>

<style scoped>
/* Добавляем lg:mt-25 если его нет в Tailwind */
@media (min-width: 1024px) {
    .lg\:mt-25 {
        margin-top: 6.25rem;
        /* 100px */
    }
}
</style>
