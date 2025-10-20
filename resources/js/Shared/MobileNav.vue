<template>
    <div>
        <!-- Бургер -->
        <button id="mobile-menu-btn"
            class="lg:hidden text-gray-800 focus:outline-none absolute right-4 md:right-5 top-1/2 -translate-y-1/2 w-8 h-8 cursor-pointer overflow-hidden transition-all duration-300"
            :aria-expanded="isOpen ? 'true' : 'false'" aria-controls="mobile-menu" aria-label="Открыть меню"
            type="button" @click="$emit('toggle')">
            <span id="bar1"
                class="block absolute left-1/2 transform -translate-x-1/2 top-2 w-8 h-0.5 bg-current transition-transform duration-300 origin-center"
                :class="{ 'translate-y-[8px] rotate-45': isOpen }"></span>
            <span id="bar2"
                class="block absolute left-1/2 transform -translate-x-1/2 top-4 w-8 h-0.5 bg-current transition-all duration-300 origin-center"
                :class="{ 'opacity-0': isOpen }"></span>
            <span id="bar3"
                class="block absolute left-1/2 transform -translate-x-1/2 top-6 w-8 h-0.5 bg-current transition-transform duration-300 origin-center"
                :class="{ '-translate-y-[8px] -rotate-45': isOpen }"></span>
        </button>

        <!-- Меню -->
        <div id="mobile-menu" class="mobile-menu lg:hidden fixed left-0 right-0" :class="{ 'is-open': isOpen }"
            :style="{ top: menuTop + 'px', height: `calc(100vh - ${menuTop}px)` }">
            <div class="mobile-menu__panel shadow-md">
                <div class="px-4 py-5 flex flex-col gap-1 text-gray-100">
                    <!-- Главная -->
                    <Link v-if="top[0]" :href="top[0].href"
                        class="no-underline transition-colors text-xl duration-200 hover:text-blue-600 focus:text-blue-600 py-1"
                        @click="closeMenu">
                    {{ top[0].label }}</Link>

                    <!-- Услуги: dropdown -->
                    <button type="button"
                        class="flex items-center justify-between w-full no-underline transition-colors text-xl duration-200 hover:text-blue-600 focus:text-blue-600 py-1 cursor-pointer"
                        :aria-expanded="isServicesOpen ? 'true' : 'false'" aria-controls="mobile-services"
                        @click="toggleServices">
                        <span>Услуги</span>
                        <svg id="chev-services" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="3" stroke="currentColor"
                            class="chevron w-6 h-6 transform transition-transform duration-300"
                            :class="{ 'rotate-180': isServicesOpen }">
                            <path d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                        </svg>
                    </button>
                    <div id="mobile-services" class="mobile-submenu" :class="{ 'is-open': isServicesOpen }">
                        <ul class="pl-3 flex flex-col gap-2">
                            <li v-for="link in services" :key="link.href">
                                <Link :href="link.href"
                                    class="no-underline transition-colors text-xl duration-200 hover:text-blue-600 focus:text-blue-600"
                                    @click="closeMenu">
                                {{ link.label }}</Link>
                            </li>
                        </ul>
                    </div>

                    <!-- Остальные верхние ссылки -->
                    <Link v-for="l in top.slice(1)" :key="l.label" :href="l.href"
                        class="no-underline transition-colors text-xl duration-200 hover:text-blue-600 focus:text-blue-600 py-1"
                        @click="closeMenu">
                    {{ l.label }}</Link>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { Link } from '@inertiajs/vue3';
import { servicesLinks, topLinks } from '../data/nav.js';
export default {
    name: 'MobileNav',
    components: { Link },
    props: {
        isOpen: { type: Boolean, default: false }
    },
    data() {
        return {
            isServicesOpen: false,
            services: servicesLinks,
            top: topLinks,
            menuTop: 0
        };
    },
    watch: {
        isOpen(val) {
            // Блокируем прокрутку страницы, когда меню открыто
            try {
                document.documentElement.style.overflow = val ? 'hidden' : '';
            } catch (e) { /* noop */ }
        }
    },
    mounted() {
        this.calculateMenuTop();
        window.addEventListener('resize', this.calculateMenuTop);
        window.addEventListener('scroll', this.calculateMenuTop);
    },
    beforeUnmount() {
        // На всякий случай возвращаем прокрутку
        try { document.documentElement.style.overflow = ''; } catch (e) { /* noop */ }
        window.removeEventListener('resize', this.calculateMenuTop);
        window.removeEventListener('scroll', this.calculateMenuTop);
    },
    methods: {
        toggleServices() {
            this.isServicesOpen = !this.isServicesOpen;
        },
        closeMenu() {
            // Закрываем меню при клике на ссылку
            this.$emit('toggle');
        },
        calculateMenuTop() {
            // Вычисляем позицию под MobileContactBar
            const contactBar = document.querySelector('.mobile-contact-bar');
            if (contactBar) {
                const rect = contactBar.getBoundingClientRect();
                this.menuTop = rect.bottom;
            } else {
                // Фолбэк на высоту навбара если контактбар не найден
                this.menuTop = 72; // var(--nav-h)
            }
        }
    }
};
</script>

<style scoped>
.mobile-menu {
    position: fixed;
    left: 0;
    right: 0;
    bottom: 0;
    overflow: hidden;
    /* внутренняя панель уезжает без появления горизонтального скролла */
    z-index: 35;
    /* ниже MobileContactBar (40), но выше nav-inner (30) */
    pointer-events: none;
    /* клики блокируем, пока закрыто */
}

.mobile-menu.is-open {
    pointer-events: auto;
}

.mobile-menu__panel {
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    width: 100vw;
    background: #232323;
    transform: translateX(100%);
    opacity: 0;
    transition: transform .32s cubic-bezier(.22, 1, .36, 1), opacity .24s ease;
}

.mobile-menu.is-open .mobile-menu__panel {
    transform: translateX(0);
    opacity: 1;
}

.mobile-submenu {
    max-height: 0;
    overflow: hidden;
    opacity: 0;
    transition: max-height .28s cubic-bezier(.22, 1, .36, 1), opacity .24s ease;
}

.mobile-submenu.is-open {
    max-height: 600px;
    opacity: 1;
}
</style>
