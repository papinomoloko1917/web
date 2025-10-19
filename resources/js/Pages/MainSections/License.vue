<template>
  <section class="relative w-full mt-10 py-10 md:py-12 text-gray-300" data-competencies-section
           style="background:#232323; box-shadow:0 0 0 100vmax #232323; clip-path:inset(0 -100vmax);">
    <div class="mx-auto w-full max-w-[1440px] px-4 sm:px-6 lg:px-8">
      <div class="relative z-10 text-center mb-8">
        <h2 id="licenses-heading"
            class="font-montserrat text-3xl md:text-4xl lg:text-4xl font-extrabold text-gray-200 mb-2" data-reveal data-delay="0">
          НАШИ КОМПЕТЕНЦИИ
        </h2>
        <h3 class="text-sm md:text-lg font-normal leading-relaxed text-gray-300/90 mt-4 max-w-3xl mx-auto"
            data-reveal data-delay="120">
          Ознакомьтесь с нашими лицензиями и сертификатами, которые гарантируют высокий уровень наших услуг и квалификацию сотрудников
        </h3>
      </div>

      <LicensesCarousel />
    </div>
  </section>
</template>

<script setup>
import LicensesCarousel from './Partials/LicensesCarousel.vue'
</script>

<style scoped>
/* Пагинация и стрелки — классы скопированы из Blade CSS блока */
/* Каркас оставляем в License.vue; стили карусели находятся в дочернем компоненте */

/* Заголовки и hover-эффекты карточек остаются тут */
[data-competencies-section] .competency-title { 
  transition: color 420ms cubic-bezier(.2,.7,.2,1);
  color: #e5e7eb; /* text-gray-200 по умолчанию */
}
[data-competencies-section] a.group:hover .competency-title,
[data-competencies-section] a.group:focus .competency-title,
[data-competencies-section] a.group:focus-visible .competency-title { 
  color: #2563eb !important; /* text-blue-600 */ 
}
[data-competencies-section] .license-card { 
  transition: background-color 420ms cubic-bezier(.2,.7,.2,1), border-color 420ms cubic-bezier(.2,.7,.2,1), box-shadow 420ms cubic-bezier(.2,.7,.2,1); 
}
[data-competencies-section] a.group:hover .license-card,
[data-competencies-section] a.group:focus .license-card,
[data-competencies-section] a.group:focus-visible .license-card { 
  background: #f1f5f9; 
  border-color: #cbd5e1; 
  box-shadow: 0 6px 18px -4px rgba(0,0,0,.25), 0 2px 6px rgba(0,0,0,.18); 
}

/* Reveal */
[data-competencies-section] [data-reveal] { will-change: transform, opacity, filter; transition: opacity 520ms cubic-bezier(.25,.65,.25,1), transform 520ms cubic-bezier(.25,.65,.25,1), filter 540ms cubic-bezier(.25,.65,.25,1); }
[data-competencies-section] [data-reveal].reveal-init { opacity: 0; transform: translateY(18px) scale(.985); filter: blur(3px) saturate(.85); }
[data-competencies-section] [data-reveal].reveal-in { opacity: 1; transform: translateY(0) scale(1); filter: blur(0) saturate(1); }
@media (prefers-reduced-motion: reduce) {
  [data-competencies-section] [data-reveal] { transition: none !important; }
  [data-competencies-section] [data-reveal].reveal-init { opacity: 1 !important; transform: none !important; filter: none !important; }
}
</style>
