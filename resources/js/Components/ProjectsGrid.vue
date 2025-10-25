<template>
    <section class="relative mt-8 md:mt-12 lg:mt-20 pt-12 lg:pt-12 border-t border-gray-700 text-gray-300"
        data-projects-section
        style="background:#232323; box-shadow: 0 0 0 100vmax #232323; clip-path: inset(0 -100vmax);">

        <!-- Опциональный заголовок -->
        <div v-if="showTitle" class="relative z-10 text-center mb-8">
            <h2 id="services-heading"
                class="font-montserrat text-3xl md:text-4xl lg:text-4xl font-extrabold text-gray-200 mb-2 transition-[transform,opacity] duration-[880ms] ease-[cubic-bezier(.2,.6,.2,1)] opacity-0 translate-y-3 will-change-transform will-change-opacity"
                data-delay="0">
                {{ title }}
            </h2>
        </div>

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

                <!-- Опциональная кнопка "Больше проектов" -->
                <div v-if="showMoreButton" class="mt-8">
                    <Link href="/projects"
                        class="projects-more-link font-monserrat w-full py-2 font-semibold text-start text-2xl md:text-3xl lg:text-4xl text-gray-200 border-b-2 border-white/70 rounded-none transition-colors duration-300 hover:text-blue-500 hover:border-blue-500 flex items-center justify-between">
                    <span>БОЛЬШЕ ПРОЕКТОВ</span>
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="flex-shrink-0 w-10 h-10 md:w-15 md:h-15 project-arrow" viewBox="0 0 512 512"
                        aria-hidden="true" focusable="false">
                        <path fill="none" stroke="currentColor" stroke-linecap="square" stroke-miterlimit="10"
                            stroke-width="60" d="M268 112l144 144-144 144M392 256H100" />
                    </svg>
                    </Link>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import { onMounted } from 'vue'
import { Link } from '@inertiajs/vue3'

const props = defineProps({
    cards: {
        type: Array,
        required: true
    },
    showTitle: {
        type: Boolean,
        default: false
    },
    title: {
        type: String,
        default: 'НАШИ ПРОЕКТЫ'
    },
    showMoreButton: {
        type: Boolean,
        default: false
    }
})

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

.projects-more-link {
    position: relative;
    display: flex;
    overflow: hidden;
}

.projects-more-link::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 0;
    height: 2px;
    background-color: #2563eb;
    transition: width 0.4s ease;
}

.projects-more-link:hover::after {
    width: 100%;
}

.project-arrow {
    transform: rotate(45deg);
    transition: transform 0.4s ease;
}

.projects-more-link:hover .project-arrow {
    transform: rotate(0deg);
}
</style>
