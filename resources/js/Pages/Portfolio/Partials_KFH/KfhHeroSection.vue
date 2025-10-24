<template>
    <section style="background: #060604;">
        <!-- Хлебные крошки -->
        <div class="container-custom">
            <nav class="flex mb-5 pt-5" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <Link href="/"
                            class="inline-flex items-center text-sm font-medium text-gray-300 hover:text-blue-400">
                        Главная
                        </Link>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-3 h-3 mx-1 text-gray-500" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg>
                            <Link href="/projects"
                                class="ml-1 text-sm font-medium text-gray-300 hover:text-blue-400 md:ml-2">
                            Проекты
                            </Link>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-3 h-3 mx-1 text-gray-500" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg>
                            <span class="ml-1 text-sm font-medium text-gray-400 md:ml-2">{{ projectName }}</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>

        <!-- Hero изображение -->
        <div data-reveal data-delay="200"
            class="relative mb-0 h-[500px] md:h-[600px] lg:h-[800px] w-full overflow-hidden">
            <img :src="mainImage" :alt="`${projectName} - главное изображение`"
                class="absolute inset-0 w-full h-full object-cover shadow-2xl hero-image" loading="eager">

            <!-- Градиентный оверлей -->
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent"></div>

            <!-- Контент -->
            <div class="container-custom h-full">
                <div class="relative h-full flex flex-col justify-end pb-6 md:pb-10 lg:pb-12">
                    <h1
                        class="font-montserrat text-3xl md:text-5xl lg:text-6xl font-extrabold tracking-tight text-white mb-4 md:mb-6">
                        {{ projectName }}
                    </h1>

                    <p class="text-base md:text-lg lg:text-xl text-gray-200 max-w-3xl mb-6 md:mb-8">
                        {{ projectSubtitle }}
                    </p>

                    <!-- Теги услуг -->
                    <div class="hidden lg:flex flex-wrap gap-2 md:gap-3">
                        <span v-for="service in serviceTags" :key="service"
                            class="bg-black/60 text-white text-xs md:text-sm font-medium px-3 md:px-4 py-1.5 md:py-2 rounded-4xl border border-white/20 backdrop-blur-sm">
                            {{ service }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    mainImage: {
        type: String,
        required: true
    },
    projectName: {
        type: String,
        required: true
    },
    projectSubtitle: {
        type: String,
        required: true
    },
    serviceTags: {
        type: Array,
        required: true
    }
});
</script>

<style scoped>
.hero-image {
    object-position: center 30%;
    transition: transform 0.3s ease;
}

.hero-image:hover {
    transform: scale(1.18);
}
</style>
