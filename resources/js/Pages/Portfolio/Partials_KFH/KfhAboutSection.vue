<template>
    <section class="about-project-section py-16 md:py-24 lg:py-32 relative" style="background-color: #060604;">
        <!-- Контент -->
        <div class="container-custom relative z-10">
            <!-- Заголовок секции -->
            <div data-reveal data-delay="200" class="mb-12 md:mb-16 lg:mb-20 text-center">
                <h2
                    class="font-montserrat text-3xl md:text-4xl lg:text-5xl font-bold tracking-tight mb-6 text-gray-100">
                    О проекте
                </h2>
                <p class="text-base md:text-lg text-gray-300 max-w-2xl mx-auto">
                    Детали реализации проекта крестьянско-фермерского хозяйства
                </p>
            </div>

            <!-- Контентная карточка -->
            <div data-reveal data-delay="400"
                class="text-content bg-white/95 md:bg-white/92 rounded-3xl shadow-2xl p-6 md:p-10 lg:p-12 max-w-5xl mx-auto backdrop-blur-sm max-w-[90%] md:max-w-5xl">
                <div class="space-y-6 md:space-y-8">
                    <!-- Основное описание -->
                    <div>
                        <h3 class="font-montserrat text-xl md:text-2xl font-bold text-gray-900 mb-4">
                            Концепция проекта
                        </h3>
                        <p class="text-base md:text-lg text-gray-700 leading-relaxed">
                            Проект крестьянско-фермерского хозяйства представляет собой комплексное решение по 
                            электротехническому обеспечению сельскохозяйственного предприятия. Мы реализовали 
                            современную инфраструктуру, отвечающую специфическим требованиям агропромышленного сектора.
                        </p>
                    </div>

                    <!-- Особенности -->
                    <div>
                        <h3 class="font-montserrat text-xl md:text-2xl font-bold text-gray-900 mb-4">
                            Выполненные работы
                        </h3>
                        <ul class="space-y-3 text-base md:text-lg text-gray-700">
                            <li class="flex items-start">
                                <svg class="w-6 h-6 text-blue-500 mr-3 mt-0.5 flex-shrink-0" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>Полный комплекс электромонтажных работ с учетом специфики объекта</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-6 h-6 text-blue-500 mr-3 mt-0.5 flex-shrink-0" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>Проектирование электроснабжения с учетом всех производственных нужд</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-6 h-6 text-blue-500 mr-3 mt-0.5 flex-shrink-0" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>Монтаж локальных компьютерных сетей для управления хозяйством</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-6 h-6 text-blue-500 mr-3 mt-0.5 flex-shrink-0" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>Установка надежной системы электроснабжения производственных помещений</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Результат -->
                    <div>
                        <h3 class="font-montserrat text-xl md:text-2xl font-bold text-gray-900 mb-4">
                            Результат
                        </h3>
                        <p class="text-base md:text-lg text-gray-700 leading-relaxed">
                            В результате реализации проекта хозяйство получило современную, надежную и эффективную 
                            инженерную инфраструктуру, которая обеспечивает бесперебойную работу всех систем и 
                            способствует повышению производительности предприятия.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
// Компонент не требует props, так как содержит статичный контент
</script>

<style scoped>
.about-project-section {
    position: relative;
}
</style>
