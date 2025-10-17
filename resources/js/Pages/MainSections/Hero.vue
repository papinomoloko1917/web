<template>
    <section ref="rootRef" class="app-container mx-auto pt-8 md:pt-12 lg:pt-16">
        <div
            :class="['grid grid-cols-1 lg:grid-cols-12 gap-10 items-center md:items-start lg:items-stretch', isVisible ? 'is-visible' : '']">
            <!-- Текст -->
            <div class="lg:col-span-6">
                <h1
                    class="font-montserrat text-4xl sm:text-4xl md:text-7xl font-extrabold leading-tight text-gray-900 mb-4 hero-title">
                    <span
                        class="block text-gray-800 transform -translate-y-6 opacity-0 transition-all duration-700 ease-out">Проектируем,</span>
                    <span
                        class="block text-gray-800 transform -translate-y-6 opacity-0 transition-all duration-700 ease-out">монтируем&nbsp;и</span>
                    <span
                        class="block text-gray-800 transform -translate-y-6 opacity-0 transition-all duration-700 ease-out">сопровождаем</span>
                    <span
                        class="block text-blue-600 transform -translate-y-6 opacity-0 transition-all duration-700 ease-out">инженерные</span>
                    <span
                        class="block text-blue-600 transform -translate-y-6 opacity-0 transition-all duration-700 ease-out">системы</span>
                </h1>

                <h2
                    class="text-2xs font-semibold md:text-xl text-gray-600 mb-4 hero-sub transform translate-y-4 opacity-0 transition-all duration-700 ease-out">
                    в городе Приморско-Ахтарск и по всему Краснодарскому краю
                </h2>

                <p
                    class="text-lg text-gray-600 mb-6 leading-relaxed hero-sub transform translate-y-4 opacity-0 transition-all duration-700 ease-out">
                    Производство работ по проектированию, монтажу и обслуживанию электроснабжения, электрооборудования,
                    противопожарной автоматики, охранных систем, видеонаблюдения, СКУД, домофонии, вентиляции и
                    кондиционирования.
                </p>

                <div
                    class="flex flex-wrap gap-3 items-center hero-sub transform translate-y-4 opacity-0 transition-all duration-700 ease-out">
                    <a href="tel:+79282547147"
                        class="inline-flex items-center justify-center px-5 py-3 bg-blue-600 text-white text-md font-semibold rounded-4xl hover:rounded-none transition-all duration-300 shadow hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        aria-label="Позвонить для расчета проекта">Рассчитать проект</a>
                </div>

                <!-- доверие / быстрые факты -->
                <div
                    class="mt-8 flex flex-wrap gap-6 text-sm text-gray-600 hero-sub transform translate-y-4 opacity-0 transition-all duration-700 ease-out">
                    <div class="flex items-center gap-3">
                        <strong class="text-gray-900"><span ref="counterYears">0</span>+</strong>
                        <span>лет опыта</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <strong class="text-gray-900"><span ref="counterObjs">0</span>+</strong>
                        <span>реализованных объектов</span>
                    </div>
                </div>
            </div>

            <!-- Карусель фото справа -->
            <div class="lg:col-span-6 flex justify-center lg:justify-center">
                <div ref="cardRef" :style="desktopCardStyle"
                    :class="['hero-card relative w-full max-w-md sm:max-w-lg md:max-w-full lg:max-w-full h-116 md:h-[44rem] rounded-lg overflow-hidden shadow-lg bg-gray-100 mx-auto transition-all duration-700 ease-out', isVisible ? 'opacity-100' : 'opacity-0']">
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-black/10 via-transparent to-transparent pointer-events-none">
                    </div>

                    <div class="hero-carousel relative w-full h-full">
                        <img v-for="(src, idx) in images" :key="src" :src="src" :alt="alts[idx] || 'hero'"
                            :class="['absolute inset-0 w-full h-full object-cover transition-opacity duration-700 ease-in-out', currentIndex === idx ? 'opacity-100' : 'opacity-0']"
                            :aria-hidden="currentIndex !== idx" />
                    </div>
                </div>
            </div>
        </div>
    </section>

</template>

<script setup>
import { ref, onMounted, onBeforeUnmount, nextTick, computed } from 'vue'

const images = [
    '/images/Hero_section_main/видеонаблюдение.jpg',
    '/images/Hero_section_main/интернет.jpg',
    '/images/Hero_section_main/камера.jpg',
    '/images/Hero_section_main/лаборатория.jpeg',
    '/images/Hero_section_main/сервер.jpg',
    '/images/Hero_section_main/Точка доступа.jpg',
    '/images/Hero_section_main/электрика.jpg',
    '/images/Hero_section_main/Электрошкаф.jpg'
]

const alts = [
    'видеонаблюдение',
    'интернет',
    'камера',
    'лаборатория',
    'сервер',
    'Точка доступа',
    'электрика',
    'Электрошкаф'
]

// карусель
const currentIndex = ref(0)
let carouselTimer = null
const rotateDelay = 3500

function startCarousel() {
    stopCarousel()
    carouselTimer = setInterval(() => {
        currentIndex.value = (currentIndex.value + 1) % images.length
    }, rotateDelay)
}
function stopCarousel() {
    if (carouselTimer) {
        clearInterval(carouselTimer)
        carouselTimer = null
    }
}

function preload() {
    images.forEach(src => {
        const img = new Image()
        img.src = src
    })
}

// анимация счётчиков
const counterYears = ref(null)
const counterObjs = ref(null)

function animateCounter(elRef, target, duration = 1400) {
    const el = elRef.value
    if (!el) return
    const start = performance.now()
    const from = 0
    function tick(now) {
        const progress = Math.min((now - start) / duration, 1)
        const value = Math.floor(from + (target - from) * progress)
        el.textContent = value.toString()
        if (progress < 1) requestAnimationFrame(tick)
        else el.textContent = target.toString()
    }
    requestAnimationFrame(tick)
}

const isVisible = ref(false)
const rootRef = ref(null)
const cardRef = ref(null)
let io = null

// Высота карточки = высоте секции на десктопе
const sectionHeight = ref(0)
const isDesktop = ref(false)
let resizeObserver = null

const desktopCardStyle = computed(() => {
    if (!isDesktop.value || sectionHeight.value === 0) return {}
    return { height: sectionHeight.value + 'px' }
})

function updateIsDesktop() {
    // Tailwind lg: >=1024px
    isDesktop.value = window.matchMedia('(min-width: 1024px)').matches
}

function measureSection() {
    const el = rootRef.value
    if (!el) return
    // Берём фактическую высоту секции (включая внутренние отступы)
    sectionHeight.value = el.getBoundingClientRect().height
}

onMounted(async () => {
    preload()
    await nextTick()

    // Инициализация десктопного режима и измерений
    updateIsDesktop()
    measureSection()

    // Следим за ресайзами контейнера и окна
    if ('ResizeObserver' in window) {
        resizeObserver = new ResizeObserver(() => {
            measureSection()
        })
        if (rootRef.value) resizeObserver.observe(rootRef.value)
    } else {
        window.addEventListener('resize', measureSection)
    }
    window.addEventListener('resize', updateIsDesktop)

    // Если нет IntersectionObserver — просто показываем и стартуем
    if (typeof IntersectionObserver === 'undefined') {
        isVisible.value = true
        startCarousel()
        animateCounter(counterYears, 14, 1400)
        animateCounter(counterObjs, 500, 1400)
        return
    }

    // Наблюдатель за самой секцией (используем ref)
    io = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                isVisible.value = true
                startCarousel()
                animateCounter(counterYears, 14, 1400)
                animateCounter(counterObjs, 500, 1400)
                io.disconnect()
            }
        })
    }, { threshold: 0.2 })

    const root = rootRef.value
    if (root) {
        // если секция уже в вьюпорте — сразу запустить (защитный кейс)
        const rect = root.getBoundingClientRect()
        if (rect.top < window.innerHeight && rect.bottom > 0) {
            isVisible.value = true
            startCarousel()
            animateCounter(counterYears, 14, 1400)
            animateCounter(counterObjs, 500, 1400)
        } else {
            io.observe(root)
        }
    }
})

onBeforeUnmount(() => {
    stopCarousel()
    if (io) io.disconnect()
    window.removeEventListener('resize', updateIsDesktop)
    if (resizeObserver && rootRef.value) resizeObserver.unobserve(rootRef.value)
    if (!('ResizeObserver' in window)) {
        window.removeEventListener('resize', measureSection)
    }
})
</script>

<style scoped>
/* ...existing styles... */
.is-visible .hero-title span,
.is-visible .hero-sub {
    transform: translateY(0) !important;
    opacity: 1 !important;
}

.h-116 {
    height: 29rem;
}

.hero-card:hover {
    cursor: default;
}
</style>