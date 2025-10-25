<template>
    <div class="relative" data-gallery-swiper>
        <!-- Свайпер для всех устройств -->
        <div class="swiper photo-gallery-swiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide" v-for="(image, index) in images" :key="index">
                    <div class="group relative overflow-hidden rounded-lg shadow-lg cursor-pointer"
                        @click="openLightbox(index)">
                        <img :src="image.src" :alt="image.alt"
                            class="w-full h-96 md:h-[420px] lg:h-[450px] object-cover transition-transform duration-300"
                            loading="lazy">
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <div class="absolute bottom-0 left-0 right-0 p-4">
                                <p class="text-white font-medium text-sm">{{ image.alt }}</p>
                            </div>
                        </div>
                        <!-- Иконка увеличения -->
                        <div
                            class="absolute top-4 right-4 bg-white/90 rounded-full p-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <svg class="w-5 h-5 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v6m3-3H7" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <div class="swiper-pagination"></div>
            <button class="swiper-button-prev hidden md:flex" type="button" aria-label="Предыдущий слайд">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="30" height="30" fill="currentColor">
                    <path d="M4 12l1.41 1.41L11 7.83V20h2V7.83l5.59 5.58L20 12l-8-8-8 8z"
                        transform="rotate(-90 12 12)" />
                </svg>
            </button>
            <button class="swiper-button-next hidden md:flex" type="button" aria-label="Следующий слайд">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="30" height="30" fill="currentColor">
                    <path d="M4 12l1.41 1.41L11 7.83V20h2V7.83l5.59 5.58L20 12l-8-8-8 8z"
                        transform="rotate(90 12 12)" />
                </svg>
            </button>
        </div>

        <!-- Lightbox для просмотра изображений -->
        <Teleport to="body">
            <Transition name="fade">
                <div v-if="isLightboxOpen" class="fixed inset-0 z-50 bg-black/95 flex items-center justify-center p-4"
                    @click="closeLightbox">
                    <!-- Кнопка закрытия -->
                    <button class="absolute top-4 right-4 text-white hover:text-gray-300 transition-colors z-10"
                        @click.stop="closeLightbox">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>

                    <!-- Навигация -->
                    <button v-if="currentImageIndex > 0"
                        class="absolute left-4 text-white hover:text-gray-300 transition-colors z-10"
                        @click.stop="previousImage">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>

                    <button v-if="currentImageIndex < images.length - 1"
                        class="absolute right-4 text-white hover:text-gray-300 transition-colors z-10"
                        @click.stop="nextImage">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>

                    <!-- Изображение -->
                    <div class="max-w-6xl max-h-full" @click.stop>
                        <img :src="images[currentImageIndex].src" :alt="images[currentImageIndex].alt"
                            class="max-w-full max-h-[85vh] object-contain">
                        <p class="text-white text-center mt-4">
                            {{ images[currentImageIndex].alt }}
                            <span class="text-gray-400 ml-2">({{ currentImageIndex + 1 }} / {{ images.length }})</span>
                        </p>
                    </div>
                </div>
            </Transition>
        </Teleport>
    </div>
</template>

<script setup>
import { ref, onMounted, onBeforeUnmount } from 'vue';
import Swiper from 'swiper';
import { Navigation, Pagination, A11y, Keyboard } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';

const props = defineProps({
    images: {
        type: Array,
        required: true,
        default: () => []
    }
});

const isLightboxOpen = ref(false);
const currentImageIndex = ref(0);
let swiperInstance = null;

const openLightbox = (index) => {
    currentImageIndex.value = index;
    isLightboxOpen.value = true;
    document.body.style.overflow = 'hidden';
};

const closeLightbox = () => {
    isLightboxOpen.value = false;
    document.body.style.overflow = '';
};

const nextImage = () => {
    if (currentImageIndex.value < props.images.length - 1) {
        currentImageIndex.value++;
    }
};

const previousImage = () => {
    if (currentImageIndex.value > 0) {
        currentImageIndex.value--;
    }
};

// Обработка клавиш клавиатуры для lightbox
const handleKeydown = (event) => {
    if (!isLightboxOpen.value) return;

    if (event.key === 'Escape') {
        closeLightbox();
    } else if (event.key === 'ArrowRight') {
        nextImage();
    } else if (event.key === 'ArrowLeft') {
        previousImage();
    }
};

onMounted(() => {
    window.addEventListener('keydown', handleKeydown);

    const container = document.querySelector('[data-gallery-swiper] .photo-gallery-swiper');
    if (container) {
        container.style.maxWidth = '100%';
        container.style.boxSizing = 'border-box';
        swiperInstance = new Swiper(container, {
            modules: [Navigation, Pagination, A11y, Keyboard],
            slidesPerView: 1,
            spaceBetween: 12,
            centeredSlides: false,
            keyboard: { enabled: true },
            a11y: true,
            watchOverflow: true,
            pagination: {
                el: '.photo-gallery-swiper .swiper-pagination',
                clickable: true
            },
            navigation: {
                nextEl: '.photo-gallery-swiper .swiper-button-next',
                prevEl: '.photo-gallery-swiper .swiper-button-prev'
            },
            breakpoints: {
                480: { slidesPerView: 1.5, spaceBetween: 14 },
                640: { slidesPerView: 2, spaceBetween: 16 },
                768: { slidesPerView: 2.5, spaceBetween: 16 },
                1024: { slidesPerView: 3, spaceBetween: 18 },
                1280: { slidesPerView: 3.5, spaceBetween: 20 },
            },
            on: {
                resize(swiper) {
                    swiper.update();
                },
                afterInit() {
                    setTimeout(() => {
                        const prev = container.querySelector('.swiper-button-prev');
                        const next = container.querySelector('.swiper-button-next');
                        [prev, next].forEach(btn => {
                            if (!btn) return;
                            const stop = (e) => {
                                if (btn.classList.contains('swiper-button-disabled')) {
                                    e.preventDefault();
                                    e.stopPropagation();
                                    e.stopImmediatePropagation?.();
                                }
                            };
                            btn.addEventListener('click', stop);
                            btn.addEventListener('pointerdown', stop);
                            btn.addEventListener('touchstart', stop, { passive: false });
                        });
                    }, 0);
                }
            }
        });
    }
});

onBeforeUnmount(() => {
    window.removeEventListener('keydown', handleKeydown);
    document.body.style.overflow = '';

    if (swiperInstance && typeof swiperInstance.destroy === 'function') {
        try {
            swiperInstance.destroy(true, true);
        } catch { }
        swiperInstance = null;
    }
});
</script>

<style scoped>
.photo-gallery-swiper {
    width: 100%;
    max-width: 100%;
    box-sizing: border-box;
    overflow-x: hidden;
    overflow-y: visible !important;
    padding-bottom: 1.5rem;
}

.photo-gallery-swiper .swiper-pagination {
    position: static !important;
    margin-top: 2rem;
    display: flex;
    justify-content: center;
    gap: .5rem;
    z-index: 20;
    align-items: center;
    padding: .25rem 0;
}

.photo-gallery-swiper :deep(.swiper-pagination-bullet) {
    width: 28px;
    height: 3px;
    background: rgba(229, 231, 235, .45);
    opacity: 1;
    border-radius: 9999px;
    transition: transform .18s ease, background-color .18s ease, width .18s ease;
    box-shadow: none;
}

.photo-gallery-swiper :deep(.swiper-pagination-bullet-active) {
    background: #e5e7eb;
    width: 40px;
    transform: scaleY(1.3);
    box-shadow: 0 4px 12px rgba(0, 0, 0, .12);
}

/* Навигационные кнопки */
.photo-gallery-swiper .swiper-button-prev,
.photo-gallery-swiper .swiper-button-next {
    position: absolute;
    top: 50%;
    --arrow-shift: calc(-50% - 13px);
    transform: translateY(var(--arrow-shift));
    width: 3.9rem;
    height: 3.9rem;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #232323;
    color: #fff;
    border: none;
    cursor: pointer;
    z-index: 30;
    box-shadow: 0 8px 18px -4px rgba(0, 0, 0, .35), 0 2px 6px rgba(0, 0, 0, .25);
    border-radius: 50%;
    transition: border-radius 420ms cubic-bezier(.2, .7, .2, 1),
        background-color 300ms cubic-bezier(.2, .7, .2, 1),
        box-shadow 300ms cubic-bezier(.2, .7, .2, 1),
        transform 300ms cubic-bezier(.2, .7, .2, 1),
        opacity 200ms ease;
    will-change: border-radius, transform;
}

.photo-gallery-swiper {
    --gallery-arrows-gap: clamp(.15rem, .9vw, .75rem);
}

.photo-gallery-swiper .swiper-button-prev {
    left: var(--gallery-arrows-gap, .5rem);
    right: auto;
}

.photo-gallery-swiper .swiper-button-next {
    right: var(--gallery-arrows-gap, .5rem);
    left: auto;
}

@media (min-width: 768px) {
    .photo-gallery-swiper {
        --gallery-arrows-gap: clamp(.35rem, .9vw, 1rem);
    }
}

.photo-gallery-swiper .swiper-button-prev::after,
.photo-gallery-swiper .swiper-button-next::after {
    display: none;
}

@media (hover: hover) and (pointer: fine) {

    .photo-gallery-swiper .swiper-button-prev:hover,
    .photo-gallery-swiper .swiper-button-next:hover {
        border-radius: 0;
        background: #2f2f2f;
        transform: translateY(var(--arrow-shift)) scale(1.06);
        box-shadow: 0 10px 26px -6px rgba(0, 0, 0, .45), 0 4px 12px rgba(0, 0, 0, .25);
    }
}

@media (hover: none) {

    .photo-gallery-swiper .swiper-button-prev,
    .photo-gallery-swiper .swiper-button-next {
        border-radius: 50%;
        background: #232323;
        transform: translateY(var(--arrow-shift));
        transition: border-radius 360ms cubic-bezier(.2, .7, .2, 1),
            background-color 280ms cubic-bezier(.2, .7, .2, 1),
            box-shadow 280ms cubic-bezier(.2, .7, .2, 1),
            transform 260ms cubic-bezier(.2, .7, .2, 1),
            opacity 200ms ease;
    }

    .photo-gallery-swiper .swiper-button-prev.touch-animate,
    .photo-gallery-swiper .swiper-button-next.touch-animate {
        border-radius: 0;
        background: #2f2f2f;
        transform: translateY(var(--arrow-shift)) scale(1.06);
        box-shadow: 0 10px 26px -6px rgba(0, 0, 0, .45), 0 4px 12px rgba(0, 0, 0, .25);
    }

    .photo-gallery-swiper .swiper-button-prev:hover,
    .photo-gallery-swiper .swiper-button-next:hover {
        border-radius: 50%;
        background: #232323;
        transform: translateY(var(--arrow-shift));
    }
}

.photo-gallery-swiper .swiper-button-prev:active,
.photo-gallery-swiper .swiper-button-next:active {
    transform: translateY(var(--arrow-shift)) scale(.95);
}

.photo-gallery-swiper .swiper-button-prev:focus-visible,
.photo-gallery-swiper .swiper-button-next:focus-visible {
    outline: 2px solid #93c5fd;
    outline-offset: 2px;
}

.photo-gallery-swiper .swiper-button-disabled {
    opacity: .35;
    cursor: not-allowed;
    box-shadow: 0 4px 10px -2px rgba(0, 0, 0, .25), 0 1px 4px rgba(0, 0, 0, .2);
    transform: translateY(var(--arrow-shift)) !important;
    pointer-events: none;
}

.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.3s ease;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
</style>
