<template>
  <section id="where-to-find" class="pt-10 pb-6 sm:pt-16 sm:pb-8 lg:pt-16 lg:pb-0">
    <div class="mx-auto w-full max-w-[1440px] px-4 sm:px-6 lg:px-8">
      <h2 data-reveal data-reveal-delay="0"
        class="text-center font-montserrat text-3xl md:text-4xl font-extrabold text-gray-900 mb-4">
        ГДЕ МЫ НАХОДИМСЯ
      </h2>

      <div class="pt-10" data-reveal data-reveal-delay="120">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
          <!-- Правая колонка: карта -->
          <div class="lg:col-span-9">
            <div class="map-wrapper relative" data-reveal data-reveal-delay="160">
              <div id="yandex-map" class="w-full h-80 md:h-[28rem] lg:h-[32rem] overflow-hidden shadow-lg bg-gray-100">
              </div>
              <noscript>
                <p class="mt-4 text-sm text-gray-600">Для просмотра карты включите JavaScript. Наш адрес: Краснодарский
                  край, город Приморско-Ахтарск, ул. Комсомольская, 66.</p>
              </noscript>
            </div>
            <div class="mt-6 lg:mt-8 lg:pb-8">
              <button id="map-build-route" type="button"
                class="inline-flex items-center justify-center w-full lg:w-auto px-6 lg:px-8 py-4 bg-blue-600 text-white text-md lg:text-lg font-semibold rounded-4xl hover:rounded-none transition-all duration-300 shadow hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 cursor-pointer text-center">
                Построить маршрут
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                  stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                  class="lucide lucide-map-icon lucide-map ml-3 md:ml-2 flex-shrink-0 relative top-0.5">
                  <path
                    d="M14.106 5.553a2 2 0 0 0 1.788 0l3.659-1.83A1 1 0 0 1 21 4.619v12.764a1 1 0 0 1-.553.894l-4.553 2.277a2 2 0 0 1-1.788 0l-4.212-2.106a2 2 0 0 0-1.788 0l-3.659 1.83A1 1 0 0 1 3 19.381V6.618a1 1 0 0 1 .553-.894l4.553-2.277a2 2 0 0 1 1.788 0z" />
                  <path d="M15 5.764v15" />
                  <path d="M9 3.236v15" />
                </svg>
              </button>
            </div>
          </div>
          <!-- Левая колонка: адрес, график -->
          <div class="lg:col-span-3">
            <div class="p-4 lg:p-6 h-full flex flex-col justify-between border border-gray-700" data-reveal
              data-reveal-delay="120">
              <dl class="grid grid-cols-1 gap-6">
                <div>
                  <dt class="text-2xl font-semibold uppercase tracking-wide text-gray-800">АДРЕС</dt>
                  <dd class="mt-1 text-gray-900">город Приморско-Ахтарск, <br> ул. Комсомольская, 66</dd>
                </div>
                <div>
                  <dt class="text-2xl font-semibold uppercase tracking-wide text-gray-800">ГРАФИК РАБОТЫ</dt>
                  <dd class="mt-1 text-gray-900">8:00 — 17:00<br><span class="text-gray-600">Выходные дни: Сб–Вс</span>
                  </dd>
                </div>
              </dl>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { onMounted, onBeforeUnmount } from 'vue'

const API_KEY = '190294b3-c731-4c53-a1f8-f64bf48ce81b'
const MAP_CONTAINER_ID = 'yandex-map'
const COORDS = [46.041753, 38.182621]
const BLUE_600 = '#2563eb'
let mapRef = null
let revealObserver = null

const ICON_SVG = '<?xml version="1.0" encoding="UTF-8"?>'
  + '<svg xmlns="http://www.w3.org/2000/svg" width="44" height="44" viewBox="0 0 44 44">'
  + '<defs>'
  + "<style><![CDATA[ .t{font:700 20px Montserrat, Arial, sans-serif; dominant-baseline:middle; text-anchor:middle; paint-order:stroke fill; stroke:#1e3a8a; stroke-width:.6px;} ]]></style>"
  + '<filter id="ds" x="-50%" y="-50%" width="200%" height="200%">'
  + '<feDropShadow dx="0" dy="1" stdDeviation="1.2" flood-color="#1e3a8a" flood-opacity="0.25"/>'
  + '</filter>'
  + '</defs>'
  + `<path d="M22 2c8.284 0 15 6.716 15 15 0 10.5-15 25-15 25S7 27.5 7 17C7 8.716 13.716 2 22 2z" fill="${BLUE_600}" filter="url(#ds)"/>`
  + '<text x="22" y="20" class="t" fill="#ffffff">V</text>'
  + '</svg>'
const ICON_DATA_URI = 'data:image/svg+xml;charset=UTF-8,' + encodeURIComponent(ICON_SVG)

function initMapOnce() {
  const el = document.getElementById(MAP_CONTAINER_ID)
  if (!el || el.dataset.inited === '1') return
  el.dataset.inited = '1'
  if (!window.ymaps) return

  window.ymaps.ready(() => {
    try {
      const map = new window.ymaps.Map(MAP_CONTAINER_ID, { center: COORDS, zoom: 16, controls: ['zoomControl'] }, { suppressMapOpenBlock: true })
      mapRef = map

      const placemark = new window.ymaps.Placemark(COORDS, { hintContent: 'Наш офис' }, {
        iconLayout: 'default#image',
        iconImageHref: ICON_DATA_URI,
        iconImageSize: [44, 44],
        iconImageOffset: [-22, -44],
      })
      map.geoObjects.add(placemark)

      const wrapper = document.querySelector('.map-wrapper')
      const mqHover = window.matchMedia('(hover:hover)')
      const isDesktopHover = mqHover.matches && window.innerWidth >= 1024
      if (isDesktopHover) {
        map.behaviors.disable('drag')
        map.behaviors.disable('scrollZoom')
        if (wrapper) {
          const enable = () => { map.behaviors.enable('drag'); map.behaviors.enable('scrollZoom') }
          const disable = () => { map.behaviors.disable('drag'); map.behaviors.disable('scrollZoom') }
          wrapper.addEventListener('pointerenter', enable)
          wrapper.addEventListener('pointerleave', disable)
        }
      } else {
        map.behaviors.enable('drag')
        map.behaviors.enable('multiTouch')
        map.behaviors.disable('scrollZoom')
      }
    } catch (e) { /* noop */ }
  })
}

function loadApiAndInit() {
  if (window.ymaps && typeof window.ymaps.Map === 'function') { initMapOnce(); return }
  const existing = document.querySelector('script[src^="https://api-maps.yandex.ru/2.1/"]')
  if (existing) { const timer = setInterval(() => { if (window.ymaps && typeof window.ymaps.Map === 'function') { clearInterval(timer); initMapOnce() } }, 120); setTimeout(() => clearInterval(timer), 10000); return }
  const s = document.createElement('script')
  s.src = `https://api-maps.yandex.ru/2.1/?apikey=${API_KEY}&lang=ru_RU`
  s.async = true
  s.onload = initMapOnce
  s.onerror = () => { }
  document.head.appendChild(s)
}

function buildRoute() {
  const openExternalRoute = (fromCoords) => {
    const url = Array.isArray(fromCoords) && fromCoords.length === 2
      ? `https://yandex.ru/maps/?rtext=${fromCoords[0]},${fromCoords[1]}~${COORDS[0]},${COORDS[1]}&rtt=auto`
      : `https://yandex.ru/maps/?rtext=~${COORDS[0]},${COORDS[1]}&rtt=auto`
    window.open(url, '_blank', 'noopener')
  }
  if (!navigator.geolocation) { openExternalRoute(); return }
  navigator.geolocation.getCurrentPosition(
    (pos) => openExternalRoute([pos.coords.latitude, pos.coords.longitude]),
    () => openExternalRoute(),
    { enableHighAccuracy: true, timeout: 5000 }
  )
}

function initReveal() {
  const root = document.getElementById('where-to-find')
  if (!root) return
  const items = root.querySelectorAll('[data-reveal]')
  items.forEach((el) => { el.classList.remove('revealed') })
  if (!('IntersectionObserver' in window)) { items.forEach(el => el.classList.add('revealed')); return }
  revealObserver = new IntersectionObserver((entries, obs) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        const el = entry.target
        const delay = parseInt(el.getAttribute('data-reveal-delay') || '0', 10)
        setTimeout(() => el.classList.add('revealed'), isNaN(delay) ? 0 : delay)
        obs.unobserve(el)
      }
    })
  }, { threshold: 0.08, rootMargin: '0px 0px -8% 0px' })
  items.forEach((el) => revealObserver.observe(el))
}

onMounted(() => {
  loadApiAndInit()
  initReveal()
  const handler = (e) => { const btn = e.target.closest && e.target.closest('#map-build-route'); if (btn) { e.preventDefault(); buildRoute() } }
  document.addEventListener('click', handler)
})

onBeforeUnmount(() => {
  try { revealObserver && revealObserver.disconnect() } catch { }
})
</script>

<style scoped>
@media (hover: hover) and (min-width: 1024px) {
  #yandex-map {
    filter: grayscale(100%);
    pointer-events: none;
    transition: filter 300ms cubic-bezier(.2, .7, .2, 1);
  }

  .map-wrapper:hover #yandex-map {
    filter: none;
    pointer-events: auto;
  }
}

#where-to-find [data-reveal] {
  opacity: 0;
  transform: translateY(16px);
  transition: opacity 700ms cubic-bezier(.2, .7, .2, 1), transform 700ms cubic-bezier(.2, .7, .2, 1);
  will-change: opacity, transform;
}

#where-to-find [data-reveal].revealed {
  opacity: 1;
  transform: none;
}
</style>