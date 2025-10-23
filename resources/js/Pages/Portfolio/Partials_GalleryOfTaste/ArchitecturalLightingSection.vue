<template>
    <section class="architectural-section" style="background: #161617;">
        <div class="container-custom py-12 lg:py-10">
            <div data-reveal data-delay="225" class="mb-0">
                <h2 class="font-montserrat text-3xl md:text-4xl lg:text-4xl font-extrabold text-gray-200 mb-10">
                    АРХИТЕКТУРНОЕ ОСВЕЩЕНИЕ</h2>

                <div class="grid grid-cols-1 lg:grid-cols-1 gap-8 mb-1">
                    <!-- Текстовое описание -->
                    <div class="space-y-4 text-gray-300">
                        <p class="text-lg leading-relaxed">
                            Нашей компанией была разработана детальная 3D-модель здания и произведен комплексный
                            светотехнический расчет для создания эффектного архитектурного освещения фасада.
                        </p>

                        <p class="leading-relaxed">
                            В процессе проектирования мы тестировали различные световые приборы с разными
                            характеристиками:
                        </p>

                        <ul class="list-disc pl-6 space-y-2">
                            <li>Различные углы излучения для оптимального освещения архитектурных элементов</li>
                            <li>Цветовая температура от теплого до холодного белого света</li>
                            <li>Световой поток разной интенсивности</li>
                            <li>Комбинации различных типов световых приборов</li>
                        </ul>

                        <p class="leading-relaxed">
                            После тщательного анализа и множества испытаний мы остановились на световых приборах
                            компании <em class="text-red-500 font-semibold">arlight</em>, которая смогла предложить
                            отличное
                            качество освещения по наиболее выгодной цене, полностью соответствующее нашим требованиям
                            и ожиданиям заказчика.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Сравнение моделей -->
        <div class="container-custom">
            <div class="w-full h-[400px] md:h-[600px]">
                <ImageComparisonSlider :image-before="imageBefore" :image-after="imageAfter"
                    alt-before="3D-модель с светотехническим расчетом" alt-after="Реализованное освещение фасада"
                    label-before="Модель DIALux" label-after="Реализация" :initial-position="50" />
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
import ImageComparisonSlider from './ImageComparisonSlider.vue';

defineProps({
    imageBefore: {
        type: String,
        required: true
    },
    imageAfter: {
        type: String,
        required: true
    }
});
</script>

<style scoped>
.architectural-section {
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
