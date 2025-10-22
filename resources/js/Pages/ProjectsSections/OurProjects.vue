<template>
  <section class="relative mt-8 md:mt-12 lg:mt-20 pt-12 lg:pt-12 border-t border-gray-700 text-gray-300"
    data-projects-section style="background:#232323; box-shadow: 0 0 0 100vmax #232323; clip-path: inset(0 -100vmax);">
    <div class="relative z-10 pt-5 pb-16">
      <div class="mx-auto w-full max-w-[1440px] px-4 sm:px-6 lg:px-8">
        <div class="mb-15 grid grid-cols-1 md:grid-cols-1 lg:grid-cols-2 gap-14">
          <article v-for="(card, i) in cards" :key="card.title"
            class="group opacity-0 translate-y-6 md:translate-y-8 scale-[.985] blur-[2px] will-change-transform will-change-opacity will-change-filter transition-[transform,opacity,filter] duration-[1000ms] md:duration-[1100ms] ease-[cubic-bezier(.2,.6,.2,1)]"
            :data-delay="card.delay || 0">
            <Link :href="card.href"
              class="block relative overflow-hidden rounded-none shadow-sm h-[26rem] sm:h-[28rem] md:h-[32rem]">
            <img :src="card.image" :alt="card.alt"
              class="w-full h-full object-cover transition-[transform,opacity,filter] duration-[1000ms] md:duration-[1100ms] ease-[cubic-bezier(.2,.6,.2,1)] translate-y-2 opacity-0 filter grayscale saturate-0 brightness-95 group-[.revealed]:translate-y-0 group-[.revealed]:opacity-100 group-hover:grayscale-0 group-hover:saturate-100 group-hover:brightness-100"
              :style="Object.assign(
                card.objectPosition ? { objectPosition: card.objectPosition, willChange: 'filter' } : { willChange: 'filter' },
                { transform: `scale(${card.imgScale || 1})` }
              )" loading="eager" fetchpriority="high" decoding="async" />

            <div
              class="project-badges absolute inset-x-0 bottom-3 flex flex-wrap gap-2 px-3 justify-start opacity-0 translate-y-2 pointer-events-none transition-all duration-500 ease-out group-hover:opacity-100 group-hover:translate-y-0 group-[.card-active]:opacity-100 group-[.card-active]:translate-y-0">
              <span v-for="(badge, j) in card.badges" :key="j"
                class="bg-black/60 text-white text-xs md:text-sm px-2.5 py-1 rounded-full border border-white/10 shadow-sm backdrop-blur-sm"
                :class="badge.delayClass || ''">
                {{ badge.text }}
              </span>
            </div>
            </Link>

            <div class="mt-4">
              <h3
                class="text-lg md:text-2xl font-semibold text-gray-200 transition-colors duration-500 group-hover:text-blue-500">
                {{ card.title }}
              </h3>
              <p class="text-gray-200 mt-3 text-sm md:text-base">{{ card.description }}</p>
            </div>
          </article>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { onMounted } from 'vue'
import { Link } from '@inertiajs/vue3'

const cards = [
  {
    title: 'ГАЛЕРЕЯ ВКУСА',
    description: 'Пекарня, кондитерская и кафе.',
    href: '/portfolio/gallery-of-taste',
    image: '/images/our_projects/pekarnya/fasade_large.jpg',
    alt: 'ГАЛЕРЕЯ ВКУСА',
    badges: [
      { text: 'Электромонтаж' },
      { text: 'Проектирование', delayClass: 'delay-100' },
      { text: 'Интернет', delayClass: 'delay-150' },
      { text: 'Видеонаблюдение', delayClass: 'delay-200' },
      { text: 'Пожарная автоматика', delayClass: 'delay-250' },
    ],
    delay: 0,
  },
  {
    title: 'НЕЗАВИСИМАЯ ЭНЕРГОСБЫТОВАЯ КОМПАНИЯ "НЭСК"',
    description: 'Офис компании, занимающейся поставками электроэнергии.',
    href: '/portfolio/nesk',
    image: '/images/our_projects/nesk/1.jpg',
    alt: 'НЭСК',
    objectPosition: '10% 10%',
    badges: [
      { text: 'Электромонтаж' },
      { text: 'Проектирование', delayClass: 'delay-100' },
      { text: 'Сети', delayClass: 'delay-150' },
      { text: 'Охранно-пожарная сигнализация', delayClass: 'delay-150' },
    ],
    delay: 240,
  },
  {
    title: 'ДИНАСТИЯ',
    description: 'Ресторанно-гостиничный комплекс.',
    href: '#',
    image: '/images/our_projects/caplya/1.jpg',
    alt: 'ДИНАСТИЯ',
    objectPosition: '10% 70%',
    badges: [
      { text: 'Электромонтаж' },
      { text: 'Проектирование', delayClass: 'delay-100' },
      { text: 'Сети', delayClass: 'delay-150' },
      { text: 'Пожарная автоматика', delayClass: 'delay-150' },
    ],
    delay: 240,
  },
  {
    title: 'КФХ',
    description: 'Крестьянско-фермерское хозяйство.',
    href: '#',
    image: '/images/our_projects/kfh_loza/1.jpg',
    alt: 'КФХ',
    objectPosition: '10% 40%',
    badges: [
      { text: 'Монтаж' },
      { text: 'Проектирование', delayClass: 'delay-100' },
      { text: 'Сети', delayClass: 'delay-150' },
    ],
    delay: 240,
  },
  {
    title: 'МАОУ СОШ № 1',
    description: 'Муниципальное автономное общеобразовательно учреждение средняя общеобразовательная школа № 1 имени А. Ф. Крамаренко.',
    href: '#',
    image: '/images/our_projects/SOSH_1/СОШ_1.jpeg',
    alt: 'МАОУ СОШ № 1',
    objectPosition: '100% 0%',
    badges: [
      { text: 'Электроснабжение' },
      { text: 'Внутренние электрические сети', delayClass: 'delay-100' },
      { text: 'Наружное и внутреннее освещение', delayClass: 'delay-150' },
      { text: 'Электротехнические испытания', delayClass: 'delay-150' },
    ],
    delay: 240,
    imgScale: 1.75
  },
  {
    title: 'ГБУ ДО КК "СШОР ВВС"',
    description: 'Государственное бюджетное образовательное учреждение дополнительного образования "Специальная школа олимпийского резерва ВВС".',
    href: '#',
    image: '/images/our_projects/shor_vodnyi/1.jpg',
    alt: 'СШОР ВВС',
    objectPosition: '0% 30%',
    badges: [
      { text: 'Электроснабжение' },
      { text: 'Наружное и внутреннее освещение', delayClass: 'delay-150' },
      { text: 'Видеонаблюдение', delayClass: 'delay-150' },
      { text: 'Локальные сети', delayClass: 'delay-150' },
      { text: 'Пожарная сигнализация', delayClass: 'delay-150' },
    ],
    delay: 240,
  },
]

onMounted(() => {
  const section = document.querySelector('[data-projects-section]')
  if (!section) return

  const reduceMotion = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches
  const items = Array.from(section.querySelectorAll('article.group'))
  const isTouch = ('ontouchstart' in window) || (navigator.maxTouchPoints > 0)
  const heading = section.querySelector('#services-heading')
  if (!items.length) return

  const showInstant = (el) => {
    el.classList.remove('opacity-0', 'translate-y-6', 'translate-y-8', 'md:translate-y-10', 'scale-[.98]', 'blur-[2px]')
    el.classList.add('opacity-100', 'translate-y-0')
  }

  if (reduceMotion) {
    items.forEach(showInstant)
    if (heading) showInstant(heading)
    return
  }

  // Ensure initial state
  items.forEach((el) => {
    if (!el.classList.contains('opacity-0')) el.classList.add('opacity-0')
    if (!el.classList.contains('translate-y-6')) el.classList.add('translate-y-6')
    el.classList.add('scale-[.985]', 'blur-[2px]')
  })
  if (heading) heading.classList.add('opacity-0', 'translate-y-4')

  const observer = new IntersectionObserver((entries, obs) => {
    entries.forEach((entry) => {
      if (!entry.isIntersecting) return
      const el = entry.target
      const delay = parseInt(el.getAttribute('data-delay') || '0', 10)
      el.style.transitionDelay = delay + 'ms'
      requestAnimationFrame(() => {
        el.classList.remove('opacity-0', 'translate-y-6', 'translate-y-8', 'md:translate-y-10', 'scale-[.98]', 'blur-[2px]')
        el.classList.add('opacity-100', 'translate-y-0')
        if (el.classList.contains('group')) el.classList.add('revealed')
      })
      obs.unobserve(el)
    })
  }, { threshold: 0.12 })

  items.forEach((el) => observer.observe(el))
  if (heading) observer.observe(heading)

  // Touch: подсветка ближайшей к центру карточки
  if (isTouch) {
    const updateActive = () => {
      const vh = window.innerHeight || document.documentElement.clientHeight
      let bestEl = null
      let bestDist = Infinity
      items.forEach((el) => {
        const rect = el.getBoundingClientRect()
        const visible = rect.bottom > 0 && rect.top < vh
        if (!visible) return
        const center = rect.top + rect.height / 2
        const dist = Math.abs(center - vh / 2)
        if (dist < bestDist) { bestDist = dist; bestEl = el }
      })
      items.forEach((el) => {
        el.classList.toggle('card-active', el === bestEl)
        const img = el.querySelector('img')
        const title = el.querySelector('h3')
        if (img) {
          if (el === bestEl) {
            img.classList.remove('grayscale', 'saturate-0', 'brightness-95')
            img.classList.add('grayscale-0', 'saturate-100', 'brightness-100')
          } else {
            img.classList.add('grayscale', 'saturate-0', 'brightness-95')
            img.classList.remove('grayscale-0', 'saturate-100', 'brightness-100')
          }
        }
        if (title) {
          if (el === bestEl) {
            title.classList.remove('text-gray-200')
            title.classList.add('text-blue-500')
          } else {
            title.classList.add('text-gray-200')
            title.classList.remove('text-blue-500')
          }
        }
      })
    }
    const activeObs = new IntersectionObserver(() => updateActive(), { threshold: [0, 0.25, 0.5, 0.75, 1] })
    items.forEach((el) => activeObs.observe(el))
    window.addEventListener('scroll', updateActive, { passive: true })
    window.addEventListener('resize', updateActive)
    updateActive()
  }
})
</script>

<style scoped>
[data-projects-section] {
  overflow-x: hidden;
}

@supports (overflow: clip) {
  [data-projects-section] {
    overflow-x: clip;
  }
}
</style>
