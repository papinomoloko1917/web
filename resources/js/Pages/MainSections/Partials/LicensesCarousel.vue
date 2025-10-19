<template>
  <div class="relative" data-competencies-swiper>
    <div class="swiper our-competencies-swiper">
      <div class="swiper-wrapper">
        <div class="swiper-slide" v-for="(doc, idx) in docs" :key="doc.title" data-reveal :data-delay="idx * 30 + 60">
          <a :href="doc.href" target="_blank" rel="noopener" class="block group" :aria-label="`Открыть документ: ${doc.title}`">
            <div class="license-card aspect-[3/4] w-full overflow-hidden border border-gray-200 bg-white shadow-sm">
              <img :src="doc.image" :alt="doc.title" loading="lazy" class="h-full w-full object-cover" />
            </div>
            <p class="mt-3 text-center text-md font-medium text-gray-200 competency-title">{{ doc.title }}</p>
          </a>
        </div>
      </div>

      <div class="swiper-pagination" aria-hidden="false"></div>
      <button class="swiper-button-prev hidden md:flex" type="button" aria-label="Предыдущий слайд">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="30" height="30" fill="currentColor" aria-hidden="true" focusable="false">
          <path d="M4 12l1.41 1.41L11 7.83V20h2V7.83l5.59 5.58L20 12l-8-8-8 8z" transform="rotate(-90 12 12)" />
        </svg>
      </button>
      <button class="swiper-button-next hidden md:flex" type="button" aria-label="Следующий слайд">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="30" height="30" fill="currentColor" aria-hidden="true" focusable="false">
          <path d="M4 12l1.41 1.41L11 7.83V20h2V7.83l5.59 5.58L20 12l-8-8-8 8z" transform="rotate(90 12 12)" />
        </svg>
      </button>
    </div>
  </div>
</template>

<script setup>
import { onMounted, onBeforeUnmount, ref } from 'vue'
import Swiper from 'swiper'
import { Navigation, Pagination, A11y, Keyboard } from 'swiper/modules'
import 'swiper/css'
import 'swiper/css/navigation'
import 'swiper/css/pagination'

// Сопоставление внешних ссылок
const externalLinks = {
  'Разрешение на производство работ по проектированию МЧС': 'https://digital.mchs.gov.ru/fgpn/cert/project/Т002-00101-23/00650390',
  'Разрешение на производство работ МЧС': 'https://digital.mchs.gov.ru/fgpn/license/23-06-2024-004469',
}

// Статичное перечисление — составлено на основе public/licenses
const rawFiles = [
  'Выписка СРО проектирование.jpg',
  'Выписка СРО проектирование.pdf',
  'Выписка СРО строители.jpg',
  'Выписка СРО строители.pdf',
  'Диплом о профессиональной переподготовке.jpeg',
  'Диплом о профессиональной переподготовке.pdf',
  'Разрешение на производство работ МЧС.jpg',
  'Разрешение на производство работ по проектированию МЧС.jpg',
  'Свидетельство о регистрации ЭТЛ.jpg',
  'Свидетельство о регистрации ЭТЛ.pdf',
  'Сертификат компании Dahua.jpg',
  'Сертификат компании Dahua.pdf',
  'Удостоверение о повышении квалификации Mikrotik.pdf',
  'Удостоверение о повышении квалификации Mikrotik.png',
]

function normalizeDocs(files) {
  const imageExts = ['jpg','jpeg','png']
  const byBase = new Map()
  files.forEach(name => {
    const dot = name.lastIndexOf('.')
    const base = dot >= 0 ? name.slice(0, dot) : name
    const ext = dot >= 0 ? name.slice(dot+1).toLowerCase() : ''
    if (imageExts.includes(ext)) {
      const existing = byBase.get(base)
      if (!existing || (name.toLowerCase().endsWith('.jpg') && !existing.toLowerCase().endsWith('.jpg'))) {
        byBase.set(base, name)
      }
    } else if (ext === 'pdf') {
      const marker = byBase.get(base)
      if (marker) {
        byBase.set(base, { image: marker, pdf: name })
      } else {
        byBase.set(base, { image: null, pdf: name })
      }
    }
  })
  const docs = []
  Array.from(byBase.keys()).sort((a,b)=>a.localeCompare(b,'ru',{numeric:true,sensitivity:'base'})).forEach(base => {
    const v = byBase.get(base)
    let imageName = typeof v === 'string' ? v : v?.image
    const pdfName = typeof v === 'object' ? v?.pdf : undefined
    const isExternal = Object.prototype.hasOwnProperty.call(externalLinks, base)
    const href = isExternal
      ? externalLinks[base]
      : pdfName
        ? `/licenses/${encodeURIComponent(pdfName)}`
        : imageName
          ? `/licenses/${encodeURIComponent(imageName)}`
          : '#'
    if (!imageName) return
    docs.push({ title: base, image: `/licenses/${encodeURIComponent(imageName)}`, href, external: isExternal })
  })
  return docs
}

const docs = ref(normalizeDocs(rawFiles))

let swiperInstance = null
let io
onMounted(() => {
  const root = document.querySelector('[data-competencies-section]')
  if (root) {
    const nodes = Array.from(root.querySelectorAll('[data-reveal]'))
    nodes.forEach(el => el.classList.add('reveal-init'))
    const reveal = (el) => {
      const delay = parseInt(el.getAttribute('data-delay') || '0', 10)
      el.style.transitionDelay = `${delay}ms`
      requestAnimationFrame(() => {
        el.classList.add('reveal-in')
        el.classList.remove('reveal-init')
      })
    }
    const viewportH = window.innerHeight || document.documentElement.clientHeight
    nodes.forEach(el => { const r = el.getBoundingClientRect(); if (r.top < viewportH * 0.85) reveal(el) })
    io = new IntersectionObserver((entries, obs) => {
      entries.forEach(entry => { if (entry.isIntersecting) { reveal(entry.target); obs.unobserve(entry.target) } })
    }, { threshold: 0.15 })
    nodes.forEach(el => { if (!el.classList.contains('reveal-in')) io.observe(el) })
  }

  const container = document.querySelector('[data-competencies-swiper] .our-competencies-swiper')
  if (container) {
    container.style.maxWidth = '100%'
    container.style.boxSizing = 'border-box'
    swiperInstance = new Swiper(container, {
      modules: [Navigation, Pagination, A11y, Keyboard],
      slidesPerView: 1,
      spaceBetween: 12,
      centeredSlides: false,
      keyboard: { enabled: true },
      a11y: true,
      watchOverflow: true,
      pagination: { el: '.our-competencies-swiper .swiper-pagination', clickable: true },
      navigation: { nextEl: '.our-competencies-swiper .swiper-button-next', prevEl: '.our-competencies-swiper .swiper-button-prev' },
      breakpoints: {
        480: { slidesPerView: 2, spaceBetween: 14 },
        640: { slidesPerView: 2.5, spaceBetween: 16 },
        768: { slidesPerView: 3, spaceBetween: 16 },
        1024: { slidesPerView: 4, spaceBetween: 18 },
        1280: { slidesPerView: 5, spaceBetween: 20 },
      },
      on: {
        resize(swiper) { swiper.update() },
        afterInit() {
          setTimeout(() => {
            const prev = container.querySelector('.swiper-button-prev')
            const next = container.querySelector('.swiper-button-next')
            ;[prev, next].forEach(btn => {
              if (!btn) return
              const stop = (e) => {
                if (btn.classList.contains('swiper-button-disabled')) {
                  e.preventDefault(); e.stopPropagation(); e.stopImmediatePropagation?.()
                }
              }
              btn.addEventListener('click', stop)
              btn.addEventListener('pointerdown', stop)
              btn.addEventListener('touchstart', stop, { passive: false })
            })
          }, 0)
        },
      },
    })
  }
})

onBeforeUnmount(() => {
  if (io) io.disconnect()
  if (swiperInstance && typeof swiperInstance.destroy === 'function') {
    try { swiperInstance.destroy(true, true) } catch {}
    swiperInstance = null
  }
})
</script>

<style scoped>
.our-competencies-swiper {
  width: 100%;
  max-width: 100%;
  box-sizing: border-box;
  overflow-x: hidden;
  overflow-y: visible !important;
  padding-bottom: 1.5rem;
}
.our-competencies-swiper .swiper-pagination {
  position: static !important;
  margin-top: 2rem;
  display: flex;
  justify-content: center;
  gap: .5rem;
  z-index: 20;
  align-items: center;
  padding: .25rem 0;
}
.our-competencies-swiper :deep(.swiper-pagination-bullet) {
  width: 28px;
  height: 3px;
  background: rgba(229,231,235,.45);
  opacity: 1;
  border-radius: 9999px;
  transition: transform .18s ease, background-color .18s ease, width .18s ease;
  box-shadow: none;
}
.our-competencies-swiper :deep(.swiper-pagination-bullet-active) {
  background: #e5e7eb;
  width: 40px;
  transform: scaleY(1.3);
  box-shadow: 0 4px 12px rgba(0,0,0,.12);
}
.our-competencies-swiper .swiper-button-prev,
.our-competencies-swiper .swiper-button-next {
  position: absolute;
  top: 50%;
  --arrow-shift: calc(-90% - 10px);
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
  box-shadow: 0 8px 18px -4px rgba(0,0,0,.35), 0 2px 6px rgba(0,0,0,.25);
  border-radius: 50%;
  transition: border-radius 420ms cubic-bezier(.2,.7,.2,1),
              background-color 300ms cubic-bezier(.2,.7,.2,1),
              box-shadow 300ms cubic-bezier(.2,.7,.2,1),
              transform 300ms cubic-bezier(.2,.7,.2,1),
              opacity 200ms ease;
  will-change: border-radius, transform;
}
.our-competencies-swiper { --competencies-arrows-gap: clamp(.15rem, .9vw, .75rem); }
.our-competencies-swiper .swiper-button-prev { left: var(--competencies-arrows-gap, .5rem); right: auto; }
.our-competencies-swiper .swiper-button-next { right: var(--competencies-arrows-gap, .5rem); left: auto; }
@media (min-width: 768px) {
  .our-competencies-swiper { --competencies-arrows-gap: clamp(.35rem, .9vw, 1rem); }
  .our-competencies-swiper .swiper-button-prev { left: var(--competencies-arrows-gap, .5rem); right: auto; }
  .our-competencies-swiper .swiper-button-next { right: var(--competencies-arrows-gap, .5rem); left: auto; }
}
.our-competencies-swiper .swiper-button-prev::after,
.our-competencies-swiper .swiper-button-next::after { display: none; }
@media (hover: hover) and (pointer: fine) {
  .our-competencies-swiper .swiper-button-prev:hover,
  .our-competencies-swiper .swiper-button-next:hover {
    border-radius: 0;
    background: #2f2f2f;
    transform: translateY(var(--arrow-shift)) scale(1.06);
    box-shadow: 0 10px 26px -6px rgba(0,0,0,.45), 0 4px 12px rgba(0,0,0,.25);
  }
}
@media (hover: none) {
  .our-competencies-swiper .swiper-button-prev,
  .our-competencies-swiper .swiper-button-next {
    border-radius: 50%;
    background: #232323;
    transform: translateY(var(--arrow-shift));
    transition: border-radius 360ms cubic-bezier(.2,.7,.2,1),
                background-color 280ms cubic-bezier(.2,.7,.2,1),
                box-shadow 280ms cubic-bezier(.2,.7,.2,1),
                transform 260ms cubic-bezier(.2,.7,.2,1),
                opacity 200ms ease;
  }
  .our-competencies-swiper .swiper-button-prev.touch-animate,
  .our-competencies-swiper .swiper-button-next.touch-animate {
    border-radius: 0;
    background: #2f2f2f;
    transform: translateY(var(--arrow-shift)) scale(1.06);
    box-shadow: 0 10px 26px -6px rgba(0,0,0,.45), 0 4px 12px rgba(0,0,0,.25);
  }
  .our-competencies-swiper .swiper-button-prev:hover,
  .our-competencies-swiper .swiper-button-next:hover {
    border-radius: 50%;
    background: #232323;
    transform: translateY(var(--arrow-shift));
  }
}
.our-competencies-swiper .swiper-button-prev:active,
.our-competencies-swiper .swiper-button-next:active { transform: translateY(var(--arrow-shift)) scale(.95); }
.our-competencies-swiper .swiper-button-prev:focus-visible,
.our-competencies-swiper .swiper-button-next:focus-visible { outline: 2px solid #93c5fd; outline-offset: 2px; }
.our-competencies-swiper .swiper-button-disabled {
  opacity: .35; cursor: not-allowed; box-shadow: 0 4px 10px -2px rgba(0,0,0,.25), 0 1px 4px rgba(0,0,0,.2);
  transform: translateY(var(--arrow-shift)) !important;
  pointer-events: none;
}

/* Hover эффект для текста карточки */
.competency-title {
  transition: color 420ms cubic-bezier(.2,.7,.2,1);
}
a.group:hover .competency-title,
a.group:focus .competency-title,
a.group:focus-visible .competency-title {
  color: #2563eb !important; /* text-blue-600 */
}
</style>