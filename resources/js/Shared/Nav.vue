<template>
    <header
        class="sticky top-0 z-40 border-b border-gray-200/60 bg-white/80 backdrop-blur dark:border-gray-800 dark:bg-gray-900/80"
    >
        <nav class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 items-center justify-between">
                <!-- Brand -->
                <div class="flex items-center gap-3">
                    <Link href="/" class="flex items-center gap-2 group">
                        <!-- Simple logo mark -->
                        <span
                            class="grid h-9 w-9 place-content-center rounded-xl bg-gradient-to-br from-indigo-500 to-violet-600 text-white shadow-sm ring-1 ring-inset ring-black/10 transition-transform duration-200 group-hover:scale-95"
                            aria-hidden="true"
                        >
                            <svg viewBox="0 0 24 24" fill="none" class="h-5 w-5">
                                <path
                                    d="M12 3l8.66 5v8L12 21l-8.66-5v-8L12 3z"
                                    class="fill-white/90"
                                />
                            </svg>
                        </span>
                        <span class="text-lg font-semibold text-gray-900 dark:text-white">WebCompany</span>
                    </Link>
                </div>

                <!-- Desktop nav -->
                <div class="hidden items-center gap-2 md:flex">
                    <Link
                        href="/"
                        :class="linkClasses(isActive('/'))"
                    >Главная</Link>

                    <div ref="dropdownRef" class="relative">
                        <button
                            type="button"
                            class="group inline-flex items-center gap-1 rounded-md px-3 py-2 text-sm font-medium text-gray-600 transition-colors hover:text-gray-900 focus:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500/50 dark:text-gray-300 dark:hover:text-white"
                            :aria-expanded="servicesOpen"
                            @click="servicesOpen = !servicesOpen"
                        >
                            Услуги
                            <svg
                                class="h-4 w-4 transition-transform duration-200 group-data-[open=true]:rotate-180"
                                :data-open="servicesOpen"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                            >
                                <path d="M6 9l6 6 6-6" />
                            </svg>
                        </button>

                        <Transition
                            enter-active-class="transition ease-out duration-150"
                            enter-from-class="opacity-0 translate-y-1"
                            enter-to-class="opacity-100 translate-y-0"
                            leave-active-class="transition ease-in duration-100"
                            leave-from-class="opacity-100 translate-y-0"
                            leave-to-class="opacity-0 translate-y-1"
                        >
                            <div
                                v-show="servicesOpen"
                                class="absolute left-0 z-50 mt-2 w-56 overflow-hidden rounded-lg border border-gray-200/70 bg-white p-2 shadow-lg ring-1 ring-black/5 dark:border-gray-700 dark:bg-gray-900"
                            >
                                <Link
                                    href="/services/design"
                                    class="block rounded-md px-3 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-gray-900 dark:text-gray-200 dark:hover:bg-gray-800 dark:hover:text-white"
                                    :class="{ 'bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white': isActive('/services/design') }"
                                >UI/UX Дизайн</Link>
                                <Link
                                    href="/services/development"
                                    class="block rounded-md px-3 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-gray-900 dark:text-gray-200 dark:hover:bg-gray-800 dark:hover:text-white"
                                    :class="{ 'bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white': isActive('/services/development') }"
                                >Разработка</Link>
                                <Link
                                    href="/services/seo"
                                    class="block rounded-md px-3 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-gray-900 dark:text-gray-200 dark:hover:bg-gray-800 dark:hover:text-white"
                                    :class="{ 'bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white': isActive('/services/seo') }"
                                >SEO/Маркетинг</Link>
                            </div>
                        </Transition>
                    </div>

                    <Link
                        href="/about"
                        :class="linkClasses(isActive('/about'))"
                    >О нас</Link>
                    <Link
                        href="/blog"
                        :class="linkClasses(isActive('/blog'))"
                    >Блог</Link>
                    <Link
                        href="/contact"
                        :class="linkClasses(isActive('/contact'))"
                    >Контакты</Link>
                </div>

                <!-- Desktop actions -->
                <div class="hidden items-center gap-3 md:flex">
                    <button
                        type="button"
                        class="inline-flex h-10 w-10 items-center justify-center rounded-lg text-gray-700 ring-1 ring-inset ring-gray-300/70 transition hover:bg-gray-50 hover:text-gray-900 dark:text-gray-200 dark:ring-gray-700 dark:hover:bg-gray-800 dark:hover:text-white"
                        @click="toggleDark"
                        :aria-pressed="isDark"
                    >
                        <span class="sr-only">Переключить тему</span>
                        <!-- Sun / Moon -->
                        <svg v-if="!isDark" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="4" />
                            <path d="M12 2v2m0 16v2m10-10h-2M4 12H2m15.364-7.364l-1.414 1.414M8.05 16.95l-1.414 1.414m0-11.314L8.05 8.05m9.9 9.9l1.414 1.414" />
                        </svg>
                        <svg v-else class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z" />
                        </svg>
                    </button>

                    <Link
                        href="/quote"
                        class="inline-flex items-center gap-2 rounded-lg bg-gradient-to-r from-indigo-600 to-violet-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:brightness-105 focus:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500/60"
                    >
                        Заказать проект
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                    </Link>
                </div>

                <!-- Mobile toggles -->
                <div class="flex items-center gap-2 md:hidden">
                    <button
                        type="button"
                        class="inline-flex h-10 w-10 items-center justify-center rounded-lg text-gray-700 ring-1 ring-inset ring-gray-300/70 transition hover:bg-gray-50 hover:text-gray-900 dark:text-gray-200 dark:ring-gray-700 dark:hover:bg-gray-800 dark:hover:text-white"
                        @click="toggleDark"
                        :aria-pressed="isDark"
                    >
                        <span class="sr-only">Переключить тему</span>
                        <svg v-if="!isDark" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="4" />
                            <path d="M12 2v2m0 16v2m10-10h-2M4 12H2m15.364-7.364l-1.414 1.414M8.05 16.95l-1.414 1.414m0-11.314L8.05 8.05m9.9 9.9l1.414 1.414" />
                        </svg>
                        <svg v-else class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z" />
                        </svg>
                    </button>

                    <button
                        type="button"
                        class="inline-flex h-10 w-10 items-center justify-center rounded-lg text-gray-700 ring-1 ring-inset ring-gray-300/70 transition hover:bg-gray-50 hover:text-gray-900 dark:text-gray-200 dark:ring-gray-700 dark:hover:bg-gray-800 dark:hover:text-white"
                        @click="mobileOpen = !mobileOpen"
                        :aria-expanded="mobileOpen"
                        aria-controls="mobile-menu"
                    >
                        <span class="sr-only">Открыть меню</span>
                        <svg v-if="!mobileOpen" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M3 6h18M3 12h18M3 18h18" />
                        </svg>
                        <svg v-else class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M6 6l12 12M6 18L18 6" />
                        </svg>
                    </button>
                </div>
            </div>
        </nav>

        <!-- Mobile menu -->
        <Transition
            enter-active-class="transition ease-out duration-150"
            enter-from-class="opacity-0 -translate-y-2"
            enter-to-class="opacity-100 translate-y-0"
            leave-active-class="transition ease-in duration-100"
            leave-from-class="opacity-100 translate-y-0"
            leave-to-class="opacity-0 -translate-y-2"
        >
            <div
                v-show="mobileOpen"
                id="mobile-menu"
                class="md:hidden border-t border-gray-200/70 bg-white px-4 py-3 dark:border-gray-800 dark:bg-gray-900"
            >
                <div class="space-y-1">
                    <Link href="/" class="block rounded-md px-3 py-2 text-base font-medium text-gray-700 hover:bg-gray-50 hover:text-gray-900 dark:text-gray-200 dark:hover:bg-gray-800 dark:hover:text-white" :class="{ 'bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white': isActive('/') }">Главная</Link>

                    <!-- Collapsible Services -->
                    <div class="rounded-md">
                        <button
                            type="button"
                            class="flex w-full items-center justify-between rounded-md px-3 py-2 text-base font-medium text-gray-700 hover:bg-gray-50 hover:text-gray-900 dark:text-gray-200 dark:hover:bg-gray-800 dark:hover:text-white"
                            @click="servicesOpen = !servicesOpen"
                            :aria-expanded="servicesOpen"
                        >
                            Услуги
                            <svg class="h-5 w-5 transition-transform" :class="{ 'rotate-180': servicesOpen }" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9l6 6 6-6"/></svg>
                        </button>
                        <div v-show="servicesOpen" class="mt-1 space-y-1 pl-3">
                            <Link href="/services/design" class="block rounded-md px-3 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-gray-900 dark:text-gray-200 dark:hover:bg-gray-800 dark:hover:text-white" :class="{ 'bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white': isActive('/services/design') }">UI/UX Дизайн</Link>
                            <Link href="/services/development" class="block rounded-md px-3 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-gray-900 dark:text-gray-200 dark:hover:bg-gray-800 dark:hover:text-white" :class="{ 'bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white': isActive('/services/development') }">Разработка</Link>
                            <Link href="/services/seo" class="block rounded-md px-3 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-gray-900 dark:text-gray-200 dark:hover:bg-gray-800 dark:hover:text-white" :class="{ 'bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white': isActive('/services/seo') }">SEO/Маркетинг</Link>
                        </div>
                    </div>

                    <Link href="/about" class="block rounded-md px-3 py-2 text-base font-medium text-gray-700 hover:bg-gray-50 hover:text-gray-900 dark:text-gray-200 dark:hover:bg-gray-800 dark:hover:text-white" :class="{ 'bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white': isActive('/about') }">О нас</Link>
                    <Link href="/blog" class="block rounded-md px-3 py-2 text-base font-medium text-gray-700 hover:bg-gray-50 hover:text-gray-900 dark:text-gray-200 dark:hover:bg-gray-800 dark:hover:text-white" :class="{ 'bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white': isActive('/blog') }">Блог</Link>
                    <Link href="/contact" class="block rounded-md px-3 py-2 text-base font-medium text-gray-700 hover:bg-gray-50 hover:text-gray-900 dark:text-gray-200 dark:hover:bg-gray-800 dark:hover:text-white" :class="{ 'bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white': isActive('/contact') }">Контакты</Link>

                    <Link href="/quote" class="mt-2 inline-flex w-full items-center justify-center gap-2 rounded-lg bg-gradient-to-r from-indigo-600 to-violet-600 px-4 py-2 text-base font-semibold text-white shadow-sm transition hover:brightness-105">Заказать проект</Link>
                </div>
            </div>
        </Transition>
    </header>
</template>

<script setup>
import { Link, usePage } from '@inertiajs/vue3';
import { computed, onMounted, onUnmounted, ref, watch } from 'vue';

const mobileOpen = ref(false);
const servicesOpen = ref(false);
const isDark = ref(false);
const dropdownRef = ref(null);

// Active link detection using Inertia's page url
const page = usePage();
// Be defensive: some adapter versions may not expose page.url
const url = computed(() => {
    const fromInertia = page && 'url' in page ? page.url : undefined;
    if (typeof fromInertia === 'string' && fromInertia.length > 0) return fromInertia;
    if (typeof window !== 'undefined' && window.location) return window.location.pathname + window.location.search + window.location.hash;
    return '/';
});

function isActive(href) {
    if (!href) return false;
    const current = url.value || '';
    if (href === '/') return current === '/';
    return typeof current === 'string' ? current.startsWith(href) : false;
}

function linkClasses(active) {
    const base = 'group relative inline-flex items-center rounded-md px-3 py-2 text-sm font-medium transition-colors';
    const idle = 'text-gray-600 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white';
    const activeCls = 'text-gray-900 dark:text-white';
    const underline = 'after:absolute after:inset-x-2 after:-bottom-0.5 after:h-0.5 after:origin-left after:scale-x-0 after:rounded-full after:bg-indigo-600 after:transition-transform group-hover:after:scale-x-100';
    const underlineActive = 'after:scale-x-100';
    return [base, underline, active ? `${activeCls} ${underlineActive}` : idle].join(' ');
}

function applyPreferredTheme() {
    const pref = localStorage.getItem('theme');
    const systemDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
    const enableDark = pref ? pref === 'dark' : systemDark;
    document.documentElement.classList.toggle('dark', enableDark);
    isDark.value = enableDark;
}

function toggleDark() {
    isDark.value = !isDark.value;
    document.documentElement.classList.toggle('dark', isDark.value);
    localStorage.setItem('theme', isDark.value ? 'dark' : 'light');
}

// Close menus on navigation
watch(url, () => {
    mobileOpen.value = false;
    servicesOpen.value = false;
});

// Close dropdown when clicking outside
function onDocClick(e) {
    if (servicesOpen.value && dropdownRef.value && !dropdownRef.value.contains(e.target)) {
        servicesOpen.value = false;
    }
}

onMounted(() => {
    applyPreferredTheme();
    document.addEventListener('click', onDocClick);
});

onUnmounted(() => {
    document.removeEventListener('click', onDocClick);
});
</script>

<style scoped>
/* No additional CSS required; everything is done via Tailwind utility classes. */
</style>