<template>
  <section class="mt-20 pt-12 lg:pt-12 border-t border-gray-300 md:mb-10 lg:mb-10 overflow-x-hidden" aria-labelledby="competencies-heading">
    <div class="app-container">
      <div class="text-center mb-8">
        <h2 id="competencies-heading"
            class="font-montserrat text-3xl md:text-4xl lg:text-4xl font-extrabold text-gray-800 mb-2 animate-root"
            data-delay="0">
          НАШИ УСЛУГИ
        </h2>
        <p class="animate-root text-sm md:text-xl lg:text-base text-gray-600 max-w-2xl mx-auto" data-delay="120">
          Комплексные решения в области безопасности, электрики и сетевой инфраструктуры для бизнеса и частных клиентов.
        </p>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-10 services-grid pt-5">
        <article v-for="(card, i) in cards" :key="card.id" role="article" :aria-labelledby="`svc-${i+1}`" tabindex="0"
                 class="group block bg-white rounded-none shadow-sm overflow-hidden border border-transparent hover:border-blue-600 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-600 transition-colors">
          <div class="card-inner animate-root" :data-delay="240 + 80 * i">
            <img :src="card.src" :alt="card.alt" class="w-full h-44 sm:h-56 object-cover animate-child" :style="card.style" loading="lazy" />
            <div class="p-6">
              <h3 :id="`svc-${i+1}`"
                  class="animate-child text-xl md:text-2xl lg:text-2xl font-semibold mb-2 text-gray-900 group-hover:text-blue-600">
                {{ card.title }}
              </h3>
              <p class="animate-child sm:text-sm md:text-base lg:text-base text-gray-800">{{ card.text }}</p>
            </div>
          </div>
        </article>
      </div>
    </div>
  </section>
</template>

<script setup>
import { onMounted, onBeforeUnmount } from 'vue'

const cards = [
  {
    id: 1,
    title: 'Видеонаблюдение',
    text: 'Проектирование, монтаж и обслуживание систем видеонаблюдения для объектов любой сложности.',
    src: '/images/Competencies/видео.jpg',
    alt: 'Видеонаблюдение',
    style: 'object-position:10% 35%;'
  },
  {
    id: 2,
    title: 'Пожарная автоматика',
    text: 'Комплексные решения по обнаружению и автоматическому реагированию на пожарные ситуации.',
    src: '/images/Competencies/Пожарка.jpg',
    alt: 'Противопожарная автоматика',
    style: 'object-position:10% 65%;'
  },
  {
    id: 3,
    title: 'Сетевые решения',
    text: 'Проектирование и развёртывание LAN/WAN, Wi‑Fi и оптических сетей под ключ.',
    src: '/images/Competencies/Сети.jpg',
    alt: 'Сетевые решения',
    style: ''
  },
  {
    id: 4,
    title: 'Безопасность',
    text: 'Системы контроля доступа, сигнализации и комплексная интеграция безопасности.',
    src: '/images/Competencies/безопасность.jpg',
    alt: 'Безопасность',
    style: ''
  },
  {
    id: 5,
    title: 'Электромонтаж',
    text: 'Полный цикл электромонтажных работ: от проектирования до ввода в эксплуатацию.',
    src: '/images/Competencies/электрика.jpg',
    alt: 'Электромонтаж',
    style: 'object-position:10% 55%;'
  },
  {
    id: 6,
    title: 'Электролаборатория',
    text: 'Испытания и измерения электроустановок, оформление отчётной документации.',
    src: '/images/Competencies/Лаборатория.jpg',
    alt: 'Электролаборатория',
    style: 'object-position:10% 70%;'
  }
]

let io

function handleReveal(entries) {
  entries.forEach(entry => {
    const root = entry.target
    const delay = Number(root.getAttribute('data-delay') || 0)
    if (entry.isIntersecting) {
      const kids = root.querySelectorAll('.animate-child')
      root.classList.add('is-visible')
      // лёгкая последовательная анимация дочерних элементов
      kids.forEach((el, idx) => {
        el.style.transitionDelay = `${(idx + 1) * 60}ms`
        el.classList.add('is-visible')
      })
    }
  })
}

onMounted(() => {
  if (typeof IntersectionObserver === 'undefined') return
  io = new IntersectionObserver(handleReveal, { threshold: 0.2 })
  document.querySelectorAll('.animate-root').forEach(el => io.observe(el))
})

onBeforeUnmount(() => {
  if (io) io.disconnect()
})
</script>

<style scoped>
/* Простые анимации появления */
.animate-root {
  opacity: 0;
  transform: translateY(14px);
  transition: opacity .6s ease, transform .6s ease;
}

.animate-root.is-visible {
  opacity: 1;
  transform: none;
}

.animate-child {
  opacity: 0;
  transform: translateY(10px);
  transition: opacity .5s ease, transform .5s ease;
}

.is-visible .animate-child {
  opacity: 1;
  transform: none;
}
</style>
