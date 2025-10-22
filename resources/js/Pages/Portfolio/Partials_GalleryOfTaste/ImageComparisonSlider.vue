<template>
    <div class="relative w-full h-full select-none overflow-hidden shadow-2xl" ref="containerRef" @mousedown="startDrag"
        @touchstart="startDrag">

        <!-- Изображение "после" (правое, всегда видно полностью) -->
        <div class="absolute inset-0">
            <img :src="imageAfter" :alt="altAfter" class="w-full h-full object-cover" draggable="false" loading="lazy">
        </div>

        <!-- Изображение "до" (левое, обрезается по ширине слайдера) -->
        <div class="absolute inset-0 overflow-hidden" :style="{ clipPath: `inset(0 ${100 - sliderPosition}% 0 0)` }">
            <img :src="imageBefore" :alt="altBefore"
                class="absolute inset-0 w-full h-full object-cover pointer-events-none" draggable="false"
                loading="lazy">
        </div>

        <!-- Вертикальная линия-разделитель -->
        <div class="absolute top-0 bottom-0 w-1 bg-white shadow-lg cursor-ew-resize"
            :style="{ left: sliderPosition + '%' }" style="transform: translateX(-50%);">

            <!-- Кнопка-ручка для перетаскивания -->
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 
                        w-12 h-12 bg-white rounded-full shadow-xl 
                        flex items-center justify-center cursor-ew-resize
                        border-4 border-blue-500
                        hover:scale-110 active:scale-95
                        transition-transform duration-200">
                <!-- Иконка стрелок влево-вправо -->
                <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                        d="M8 7l-5 5 5 5M16 7l5 5-5 5" />
                </svg>
            </div>
        </div>

        <!-- Метки "До" и "После" -->
        <div
            class="absolute top-4 left-4 bg-black/60 text-white px-3 py-1.5 rounded-full text-sm font-semibold backdrop-blur-sm pointer-events-none">
            {{ labelBefore }}
        </div>
        <div
            class="absolute top-4 right-4 bg-black/60 text-white px-3 py-1.5 rounded-full text-sm font-semibold backdrop-blur-sm pointer-events-none">
            {{ labelAfter }}
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue';

const props = defineProps({
    imageBefore: {
        type: String,
        required: true
    },
    imageAfter: {
        type: String,
        required: true
    },
    altBefore: {
        type: String,
        default: 'Изображение до'
    },
    altAfter: {
        type: String,
        default: 'Изображение после'
    },
    labelBefore: {
        type: String,
        default: 'Проект'
    },
    labelAfter: {
        type: String,
        default: 'Реализация'
    },
    initialPosition: {
        type: Number,
        default: 50,
        validator: (value) => value >= 0 && value <= 100
    }
});

const containerRef = ref(null);
const sliderPosition = ref(props.initialPosition);
const isDragging = ref(false);

const updateSliderPosition = (clientX) => {
    if (!containerRef.value) return;

    const rect = containerRef.value.getBoundingClientRect();
    const x = clientX - rect.left;
    const percentage = (x / rect.width) * 100;

    // Ограничиваем значение между 0 и 100
    sliderPosition.value = Math.max(0, Math.min(100, percentage));
};

const startDrag = (e) => {
    isDragging.value = true;

    // Для touch событий используем первое касание
    const clientX = e.type === 'touchstart' ? e.touches[0].clientX : e.clientX;
    updateSliderPosition(clientX);

    // Предотвращаем выделение текста при перетаскивании
    e.preventDefault();
};

const onDrag = (e) => {
    if (!isDragging.value) return;

    const clientX = e.type === 'touchmove' ? e.touches[0].clientX : e.clientX;
    updateSliderPosition(clientX);
};

const stopDrag = () => {
    isDragging.value = false;
};

onMounted(() => {
    // Глобальные слушатели для перетаскивания
    document.addEventListener('mousemove', onDrag);
    document.addEventListener('mouseup', stopDrag);
    document.addEventListener('touchmove', onDrag, { passive: false });
    document.addEventListener('touchend', stopDrag);
});

onUnmounted(() => {
    document.removeEventListener('mousemove', onDrag);
    document.removeEventListener('mouseup', stopDrag);
    document.removeEventListener('touchmove', onDrag);
    document.removeEventListener('touchend', stopDrag);
});
</script>

<style scoped>
/* Убираем синий highlight на мобильных при touch */
* {
    -webkit-tap-highlight-color: transparent;
    -webkit-touch-callout: none;
    -webkit-user-select: none;
    user-select: none;
}

/* Плавная анимация при отпускании */
.cursor-ew-resize {
    cursor: ew-resize;
}
</style>
