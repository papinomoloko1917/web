<template>
    <section class="about-project-section section-transition-top section-transition-bottom">
        <div class="about-project-overlay"></div>
        <div class="container-custom py-6 md:py-7 lg:py-22 relative z-10">
            <div data-reveal data-delay="250" class="grid lg:grid-cols-2 gap-6 md:gap-8 lg:gap-12 items-center">
                <!-- Текстовый блок -->
                <div class="prose prose-base md:prose-lg max-w-none text-content">
                    <h2 class="font-montserrat text-xl md:text-2xl lg:text-3xl font-bold mb-4 md:mb-6 project-title">О
                        проекте</h2>
                    <div class="space-y-3 md:space-y-4 project-description">
                        <p class="text-sm md:text-base">
                            Проект "МФЦ" представляет собой современный многофункциональный центр предоставления
                            государственных и муниципальных услуг. Мы выполнили полный комплекс работ по
                            электротехническому оснащению и обеспечению безопасности объекта.
                        </p>
                        <p class="text-sm md:text-base font-semibold">
                            В рамках проекта были реализованы следующие системы:
                        </p>
                        <ul class="list-disc pl-5 md:pl-6 space-y-1.5 md:space-y-2 text-sm md:text-base">
                            <li>Полное электроснабжение административного здания</li>
                            <li>Наружное и внутреннее освещение территории и помещений</li>
                            <li>Система видеонаблюдения для контроля безопасности</li>
                            <li>Проектирование и монтаж локальных компьютерных сетей</li>
                            <li>Установка пожарной сигнализации и систем безопасности</li>
                            <li>Система оповещения и управления эвакуацией</li>
                        </ul>
                        <p class="text-sm md:text-base">
                            Все работы были выполнены в соответствии с современными стандартами качества и требованиями
                            безопасности административных зданий. Объект успешно функционирует и обслуживает граждан.
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </section>
</template>

<script setup>


</script>

<style scoped>
/* Стиль секции с фоновым изображением */
.about-project-section {
    position: relative;
    background: #f8fafcfa url('/images/our_projects/mfc/tittle.jpg') no-repeat center center;
    background-size: 100% auto;
    background-position: center 45%;
    margin-top: 0;
    width: 100%;
    min-height: 400px;
}

/* Адаптивный фон для десктопа - уменьшаем высоту */
@media (min-width: 1024px) {
    .about-project-section {
        min-height: 280px;
    }
}

/* Адаптивный фон для мобильных устройств */
@media (max-width: 768px) {
    .about-project-section {
        background-size: cover;
        background-position: center 50%;
        min-height: 500px;
        padding-top: 3rem;
        padding-bottom: 3rem;
    }
}

/* Полупрозрачный оверлей для лучшей читаемости текста */
.about-project-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(248, 250, 252, 0.3);
    z-index: 1;
}

/* Адаптивный оверлей для мобильных */
@media (max-width: 768px) {
    .about-project-overlay {
        background: rgba(248, 250, 252, 0.25);
    }
}

/* Стиль для текстового контента */
.text-content {
    background: rgba(255, 255, 255, 0.55);
    padding: 1.5rem;
    border-radius: 0.5rem;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
    backdrop-filter: blur(15px);
    transition: all 0.3s ease;
}

/* Улучшенные стили для мобильных */
@media (max-width: 768px) {
    .text-content {
        padding: 1.25rem;
        border-radius: 0.375rem;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.12);
        background: rgba(255, 255, 255, 0.50);
        max-width: 90%;
        margin: 0 auto;
    }
}

@media (min-width: 768px) {
    .text-content {
        padding: 2rem;
    }
}

/* Стили для заголовка */
.project-title {
    color: #1a1a1a;
    line-height: 1.3;
}

@media (max-width: 640px) {
    .project-title {
        font-size: 1.25rem;
    }
}

/* Стили для описания */
.project-description {
    color: #2d3748;
    line-height: 1.6;
}

@media (max-width: 640px) {
    .project-description {
        line-height: 1.5;
    }
}

/* Улучшенный список для мобильных */
.project-description ul li {
    padding-left: 0.25rem;
    line-height: 1.5;
}

@media (min-width: 768px) {
    .project-description ul li {
        line-height: 1.6;
    }
}

/* Анимация при наведении на десктопе */
@media (min-width: 1024px) {
    .text-content:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    }
}

/* Плавный переход сверху секции */
.section-transition-top::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 60px;
    background: linear-gradient(to bottom, #060604, transparent);
    pointer-events: none;
    z-index: 5;
}

@media (max-width: 768px) {
    .section-transition-top::before {
        height: 50px;
    }
}

/* Плавный переход снизу секции */
.section-transition-bottom::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    height: 60px;
    background: linear-gradient(to bottom, transparent, #161617);
    pointer-events: none;
    z-index: 5;
}

@media (max-width: 768px) {
    .section-transition-bottom::after {
        height: 50px;
    }
}
</style>
