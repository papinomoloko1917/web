<template>
    <section ref="rootRef" class="-mt-8 pt-0 lg:mt-0 lg:pt-20 overflow-x-hidden">
        <div class="relative min-h-[28rem] sm:min-h-[32rem] md:min-h-[48rem] lg:min-h-0 w-full lg:max-w-[1440px] lg:mx-auto lg:px-6"
            :class="['lg:grid lg:grid-cols-12 lg:gap-10 lg:items-stretch', isVisible ? 'is-visible' : '']">
            <!-- Текст -->
            <div ref="textColRef" class="relative z-10 lg:z-auto lg:col-span-6 px-4 sm:px-6 lg:px-0 pt-[28rem] sm:pt-[32rem] md:pt-[48rem] lg:pt-0">
                <!-- Десктопный заголовок слева -->
                <h1 class="hidden lg:block font-montserrat text-4xl sm:text-4xl md:text-7xl font-extrabold leading-tight text-gray-900 hero-title">
                    <span class="block text-gray-800 transform -translate-y-6 opacity-0 transition-all duration-700 ease-out">Проектируем,</span>
                    <span class="block text-gray-800 transform -translate-y-6 opacity-0 transition-all duration-700 ease-out">монтируем&nbsp;и</span>
                    <span class="block text-gray-800 transform -translate-y-6 opacity-0 transition-all duration-700 ease-out">сопровождаем</span>
                    <span class="block text-blue-600 transform -translate-y-6 opacity-0 transition-all duration-700 ease-out">инженерные</span>
                    <span class="block text-blue-600 transform -translate-y-6 opacity-0 transition-all duration-700 ease-out">системы</span>
                </h1>

                <h2
                    class="text-lg font-semibold md:text-3xl text-gray-800 lg:text-gray-600 mb-1 py-2">
                    в городе Приморско-Ахтарск и по всему Краснодарскому краю
                </h2>

                <p
                    class="text-md md:text-lg text-gray-800 lg:text-gray-600 mb-4">
                    Производство работ по проектированию, монтажу и обслуживанию электроснабжения, электрооборудования,
                    противопожарной автоматики, охранных систем, видеонаблюдения, СКУД, домофонии, вентиляции и
                    кондиционирования.
                </p>

                <div
                    class="flex flex-wrap gap-3 py-5 items-center">
                    <a href="tel:+79282547147"
                        class="w-full sm:w-auto inline-flex items-center justify-center px-5 py-3 bg-blue-600 text-white text-md font-semibold rounded-4xl hover:rounded-none transition-all duration-300 shadow hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        aria-label="Позвонить для расчета проекта">Рассчитать проект</a>
                </div>

                <!-- доверие / быстрые факты -->
                <div
                    class="mt-5 flex flex-wrap gap-6 text-sm text-gray-700 lg:text-gray-600 hero-sub">
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
            <div class="absolute top-0 left-0 right-0 pointer-events-none lg:relative lg:pointer-events-auto lg:col-span-6 flex justify-center lg:mx-0">
                <div ref="cardRef" :style="desktopCardStyle"
                    :class="['hero-card relative w-screen lg:w-full h-[28rem] sm:h-[32rem] md:h-[48rem] lg:h-full lg:max-w-full rounded-none overflow-hidden shadow-lg bg-gray-100', isVisible ? 'opacity-100' : 'opacity-0']">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/75 via-black/35 to-transparent lg:from-black/10 lg:via-transparent lg:to-transparent pointer-events-none"></div>

                    <div class="hero-carousel relative w-full h-full">
                        <img v-for="(src, idx) in images" :key="src" :src="src" :alt="alts[idx] || 'hero'"
                            :class="['absolute inset-0 w-full h-full object-cover transition-opacity duration-700 ease-in-out', currentIndex === idx ? 'opacity-100' : 'opacity-0']"
                            :aria-hidden="currentIndex !== idx" />
                    </div>

                    <!-- Мобильный/планшетный заголовок поверх фото -->
                                        <div class="absolute inset-x-0 bottom-0 px-1.5 py-0 sm:px-6 sm:py-0 lg:hidden">
                                                <!-- Бегущая строка с отдельным фоном -->
                                                <div class="bg-black/50 sm:bg-black/50 backdrop-blur-sm rounded-lg sm:rounded-xl mb-8 sm:mb-8 mx-1.5 sm:mx-0 overflow-hidden">
                                                    <MarqueeHeadline
                                                        :items="['ПРОЕКТИРУЕМ', 'МОНТИРУЕМ', 'СОПРОВОЖДАЕМ']"
                                                        :speed="86"
                                                        container-class="w-full py-1"
                                                        chip-class="inline-block"
                                                        text-class="font-montserrat text-3xl sm:text-4xl md:text-5xl font-extrabold leading-tight text-white drop-shadow-[0_4px_20px_rgba(0,0,0,0.8)] tracking-wide uppercase"
                                                    />
                                                </div>

                                                <!-- Статичный синий текст с отдельными фонами -->
                                                <div class="flex flex-col gap-2 sm:gap-2.5 mx-1.5 sm:mx-0">
                                                    <span class="inline-block self-start bg-black/50 sm:bg-black/60 backdrop-blur-sm rounded-lg sm:rounded-xl px-2 sm:px-3 py-1 sm:py-1.5 font-montserrat text-3xl sm:text-4xl md:text-5xl font-extrabold leading-tight text-blue-400 drop-shadow-[0_4px_20px_rgba(0,0,0,0.8)] tracking-wide uppercase hero-title-span transform -translate-y-6 opacity-0 transition-all duration-700 ease-out">инженерные</span>
                                                    <span class="inline-block self-start bg-black/50 sm:bg-black/60 backdrop-blur-sm rounded-lg sm:rounded-xl px-2 sm:px-3 py-1 sm:py-1.5 font-montserrat text-3xl sm:text-4xl md:text-5xl font-extrabold leading-tight text-blue-400 drop-shadow-[0_4px_20px_rgba(0,0,0,0.8)] tracking-wide uppercase hero-title-span transform -translate-y-6 opacity-0 transition-all duration-700 ease-out">системы</span>
                                                </div>
                                        </div>
                </div>
            </div>
        </div>
    </section>

</template>

<script setup>
import { ref, onMounted, onBeforeUnmount, nextTick, computed } from 'vue'
import MarqueeHeadline from './Partials/MarqueeHeadline.vue'

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
const textColRef = ref(null)
let io = null

// Высота карточки = высоте левой колонки (текст) на десктопе
const cardHeight = ref(0)
const isDesktop = ref(false)
let resizeObserver = null

const desktopCardStyle = computed(() => {
    if (!isDesktop.value || cardHeight.value === 0) return {}
    return { height: cardHeight.value + 'px' }
})

function updateIsDesktop() {
    // Tailwind lg: >=1024px
    isDesktop.value = window.matchMedia('(min-width: 1024px)').matches
}

function measureTarget() {
    const col = textColRef.value
    if (!col) return
    // Измеряем фактическую высоту левой колонки (стабильная величина)
    cardHeight.value = Math.ceil(col.getBoundingClientRect().height)
}

onMounted(async () => {
    preload()
    await nextTick()

    // Инициализация десктопного режима и измерений
    updateIsDesktop()
    measureTarget()

    // Следим за ресайзами контейнера и окна
    if ('ResizeObserver' in window) {
        resizeObserver = new ResizeObserver(() => {
            // наблюдаем только за левой колонкой, чтобы избежать цикла размеров
            measureTarget()
        })
        if (textColRef.value) resizeObserver.observe(textColRef.value)
    } else {
        window.addEventListener('resize', measureTarget)
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
    if (resizeObserver && textColRef.value) resizeObserver.unobserve(textColRef.value)
    if (!('ResizeObserver' in window)) {
        window.removeEventListener('resize', measureTarget)
    }
})
</script>

<style scoped>
/* ...existing styles... */
.is-visible .hero-title span,
.is-visible .hero-title-span,
.is-visible .hero-sub {
    transform: translateY(0) !important;
    opacity: 1 !important;
}

/* На мобильных фон-карусель заполняет секцию, высота секции определяется контентом */
/* Старая высота .h-116 больше не используется (заменили на h-full в фоне) */
.h-116 { height: 29rem; }

.hero-card:hover {
    cursor: default;
}

/* кастомный оверрайд для высоты на md больше не нужен — используем utility-классы */
</style>