<template>
    <section class="mt-0 pt-12 lg:pt-12 border-t border-gray-300 md:mb-10 lg:mb-10" aria-labelledby="requisites-heading"
        data-requisites-section>
        <div class="container-custom">
            <h2 id="requisites-heading" data-reveal data-delay="0"
                class="text-center font-montserrat text-3xl md:text-4xl font-extrabold text-gray-900 mb-8">
                РЕКВИЗИТЫ КОМПАНИИ
            </h2>

            <div class="mt-12 max-w-4xl mx-auto">
                <div class="bg-white border border-gray-200 rounded-lg shadow-sm p-6 md:p-8" data-reveal
                    data-delay="100">
                    <dl class="space-y-4">
                        <div class="flex flex-col sm:flex-row sm:gap-4">
                            <dt class="font-semibold text-gray-900 min-w-[240px]">Адрес:</dt>
                            <dd class="text-gray-700 mt-1 sm:mt-0">
                                353865, Краснодарский край, Приморско-Ахтарский р-н, г. Приморско-Ахтарск, ул.
                                Комсомольская, 66
                            </dd>
                        </div>

                        <div class="flex flex-col sm:flex-row sm:gap-4">
                            <dt class="font-semibold text-gray-900 min-w-[240px]">Телефон:</dt>
                            <dd class="text-gray-700 mt-1 sm:mt-0">
                                <a href="tel:+79182547147" class="hover:text-blue-600 transition-colors">
                                    +7 918 254 71 47
                                </a>
                            </dd>
                        </div>

                        <div class="flex flex-col sm:flex-row sm:gap-4">
                            <dt class="font-semibold text-gray-900 min-w-[240px]">E-mail:</dt>
                            <dd class="text-gray-700 mt-1 sm:mt-0">
                                <a href="mailto:ip_varivoda@mail.ru" class="hover:text-blue-600 transition-colors">
                                    ip_varivoda@mail.ru
                                </a>
                            </dd>
                        </div>

                        <div class="border-t border-gray-200 my-4"></div>

                        <div class="flex flex-col sm:flex-row sm:gap-4">
                            <dt class="font-semibold text-gray-900 min-w-[240px]">Свидетельство:</dt>
                            <dd class="text-gray-700 mt-1 sm:mt-0">23 № 008152757 от 22.04.2011</dd>
                        </div>

                        <div class="flex flex-col sm:flex-row sm:gap-4">
                            <dt class="font-semibold text-gray-900 min-w-[240px]">ОГРН:</dt>
                            <dd class="text-gray-700 mt-1 sm:mt-0 font-mono">311234711200032</dd>
                        </div>

                        <div class="flex flex-col sm:flex-row sm:gap-4">
                            <dt class="font-semibold text-gray-900 min-w-[240px]">ИНН:</dt>
                            <dd class="text-gray-700 mt-1 sm:mt-0 font-mono">234701510918</dd>
                        </div>

                        <div class="flex flex-col sm:flex-row sm:gap-4">
                            <dt class="font-semibold text-gray-900 min-w-[240px]">ОКПО:</dt>
                            <dd class="text-gray-700 mt-1 sm:mt-0 font-mono">0178231029</dd>
                        </div>

                        <div class="flex flex-col sm:flex-row sm:gap-4">
                            <dt class="font-semibold text-gray-900 min-w-[240px]">ОКТМО:</dt>
                            <dd class="text-gray-700 mt-1 sm:mt-0 font-mono">03541000</dd>
                        </div>

                        <div class="border-t border-gray-200 my-4"></div>

                        <div class="flex flex-col sm:flex-row sm:gap-4">
                            <dt class="font-semibold text-gray-900 min-w-[240px]">Расчетный счет:</dt>
                            <dd class="text-gray-700 mt-1 sm:mt-0 font-mono">40802810800330000143</dd>
                        </div>

                        <div class="flex flex-col sm:flex-row sm:gap-4">
                            <dt class="font-semibold text-gray-900 min-w-[240px]">Банк:</dt>
                            <dd class="text-gray-700 mt-1 sm:mt-0">КБ «Кубань Кредит» ООО г. Краснодар</dd>
                        </div>

                        <div class="flex flex-col sm:flex-row sm:gap-4">
                            <dt class="font-semibold text-gray-900 min-w-[240px]">БИК:</dt>
                            <dd class="text-gray-700 mt-1 sm:mt-0 font-mono">040349722</dd>
                        </div>

                        <div class="flex flex-col sm:flex-row sm:gap-4">
                            <dt class="font-semibold text-gray-900 min-w-[240px]">Корреспондентский счет:</dt>
                            <dd class="text-gray-700 mt-1 sm:mt-0 font-mono">30101810200000000722</dd>
                        </div>

                        <div class="flex flex-col sm:flex-row sm:gap-4">
                            <dt class="font-semibold text-gray-900 min-w-[240px]">Адрес банка:</dt>
                            <dd class="text-gray-700 mt-1 sm:mt-0">
                                350000, г. Краснодар, Ул. Им. Орджоникидзе/Ул. Красноармейская, Д.46/32
                            </dd>
                        </div>
                    </dl>

                    <!-- Кнопка распечатать -->
                    <div class="mt-8 pt-6 border-t border-gray-200 flex justify-center" data-reveal data-delay="200">
                        <a :href="documentUrl" target="_blank" rel="noopener noreferrer"
                            class="font-montserrat print-button inline-flex items-center gap-2 px-6 py-3 bg-blue-600 text-white font-semibold rounded-4xl shadow-md hover:shadow-lg transition-all duration-300 transform ">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0 1 10.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0 .229 2.523a1.125 1.125 0 0 1-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0 0 21 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 0 0-1.913-.247M6.34 18H5.25A2.25 2.25 0 0 1 3 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 0 1 1.913-.247m10.5 0a48.536 48.536 0 0 0-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5Zm-3 0h.008v.008H15V10.5Z" />
                            </svg>
                            <span>Распечатать</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="mt-15 border-t border-gray-300" aria-hidden="true"></div>
</template>

<script setup>
import { onMounted } from 'vue';

const documentUrl = '/documents/Company_card.pdf';

onMounted(() => {
    // Reveal-эффект при скролле
    initRevealAnimation();
});

function initRevealAnimation() {
    const root = document.querySelector('[data-requisites-section]');
    if (!root) return;

    const nodes = Array.from(root.querySelectorAll('[data-reveal]'));
    if (!nodes.length) return;

    const reduce = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    if (!reduce) {
        nodes.forEach(el => el.classList.add('reveal-init'));
    }

    const reveal = (el) => {
        const delay = parseInt(el.getAttribute('data-delay') || '0', 10);

        if (reduce) {
            el.classList.remove('reveal-init');
            el.classList.add('reveal-in');
            return;
        }

        el.style.transitionDelay = delay + 'ms';
        requestAnimationFrame(() => {
            el.classList.add('reveal-in');
            el.classList.remove('reveal-init');
        });
    };

    const viewportH = window.innerHeight || document.documentElement.clientHeight;
    nodes.forEach(el => {
        const r = el.getBoundingClientRect();
        if (r.top < viewportH * 0.85) reveal(el);
    });

    if (reduce) return;

    const io = new IntersectionObserver((entries, obs) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                reveal(entry.target);
                obs.unobserve(entry.target);
            }
        });
    }, { threshold: 0.15 });

    nodes.forEach(el => {
        if (!el.classList.contains('reveal-in')) io.observe(el);
    });
}
</script>

<style scoped>
/* Reveal анимация для этой секции */
[data-requisites-section] [data-reveal] {
    will-change: transform, opacity, filter;
    transition: opacity 500ms cubic-bezier(.25, .65, .25, 1),
        transform 500ms cubic-bezier(.25, .65, .25, 1),
        filter 520ms cubic-bezier(.25, .65, .25, 1);
}

[data-requisites-section] [data-reveal].reveal-init {
    opacity: 0;
    transform: translateY(16px) scale(.985);
    filter: blur(2px) saturate(.9);
}

[data-requisites-section] [data-reveal].reveal-in {
    opacity: 1;
    transform: translateY(0) scale(1);
    filter: blur(0) saturate(1);
}

@media (prefers-reduced-motion: reduce) {
    [data-requisites-section] [data-reveal] {
        transition: none !important;
    }

    [data-requisites-section] [data-reveal].reveal-init {
        opacity: 1 !important;
        transform: none !important;
        filter: none !important;
    }
}

.print-button {
    border-radius: 2rem;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.print-button:hover {
    border-radius: 0;
    background-color: #1d4ed8;
    /* blue-700 */
    transform: translateY(-1px);
    box-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
}

.print-button:active {
    transform: translateY(0);
}
</style>
