<template>
  <div class="w-full overflow-hidden" :class="containerClass">
    <div class="marquee-track animate-marquee inline-flex items-center whitespace-nowrap" :style="trackStyle">
      <!-- Дублируем контент 16 раз для идеальной бесшовности -->
      <template v-for="setNum in 16" :key="`set-${setNum}`">
        <template v-for="(item, idx) in items" :key="`set${setNum}-${idx}`">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 sm:w-8 sm:h-8 md:w-10 md:h-10 text-white/70 mx-3 sm:mx-4 md:mx-5 shrink-0" aria-hidden="true" focusable="false">
            <path d="m21 7.5-9-5.25L3 7.5m18 0-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9" />
          </svg>
          <span :class="chipClass">
            <span :class="textClass">{{ item }}</span>
          </span>
        </template>
      </template>
    </div>
  </div>
  
</template>

<script setup>
import { computed } from 'vue'

const props = defineProps({
  items: { type: Array, required: true },
  speed: { type: Number, default: 18 }, // сек на один полный цикл
  containerClass: { type: String, default: '' },
  chipClass: { type: String, default: '' },
  textClass: { type: String, default: '' },
})

const trackStyle = computed(() => ({
  '--dur': `${props.speed}s`,
}))
</script>

<style scoped>
@keyframes marquee {
  0% { transform: translateX(0); }
  100% { transform: translateX(-50%); }
}
.animate-marquee { 
  animation: marquee var(--dur, 18s) linear infinite; 
}
.marquee-track { 
  will-change: transform;
}
/* Гарантируем скрытие переполнения */
:deep(.w-full) {
  overflow: hidden !important;
}
</style>
