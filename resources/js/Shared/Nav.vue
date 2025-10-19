<template>
    <nav
        :class="['nav-root relative flex items-center py-2 transition-all duration-300', { 'nav--expanded': expanded }]">
        <!-- Верхняя полоска меняет цвет самого navbar без смещения содержимого -->
        <div class="nav-top-bg" :class="{ 'is-expanded': expanded }" aria-hidden="true"></div>
        <!-- Фоновая полоса на всю ширину экрана, меняет цвет и высоту -->
        <div class="nav-bg" :class="{ 'is-expanded': expanded }" aria-hidden="true"></div>

        <!-- Полноширинная зона, объединяющая шапку и панель; закрываем только при уходе с неё -->
        <div class="nav-zone" :class="{ 'is-expanded': expanded }" @mouseleave="onNavMouseLeave">
            <!-- Внутренний контейнер шапки (логотип + основные пункты). Он не смещается -->
            <div class="nav-inner w-full">
                <div class="flex items-center" :class="{ 'text-[#e5e7eb]': expanded, 'text-gray-800': !expanded }">
                    <slot name="logo">
                        <Logo />
                    </slot>
                </div>

                <DesktopNav ref="desktop" :expanded="expanded" @open-panel="openPanel" @close-panel="maybeClosePanel"
                    @top-item-enter="onTopItemEnter" @top-item-leave="onTopItemLeave" @link-enter="onLinkEnter"
                    @link-leave="onLinkLeave" />

                <!-- Телефон справа (десктоп) -->
                <div class="ml-auto hidden lg:flex items-center">
                    <HeaderTelephone :expanded="expanded" phone="+7 (918) 254 71 47" tel="+79182547147" />
                </div>

                <!-- Бургер: только мобильные/планшеты -->
                <MobileNav :isOpen="isMobileOpen" @toggle="toggleMobile" />
            </div>

            <ServicesPanel :expanded="expanded" @panel-hover="panelHover = $event" @item-hover="onPanelItemsHover"
                @link-enter="onPanelLinkEnter" @link-leave="onPanelLinkLeave" />
        </div>
    </nav>
</template>

<script>
import Logo from '../Components/Header/Logo.vue';
import DesktopNav from './DesktopNav.vue';
import MobileNav from './MobileNav.vue';
import ServicesPanel from '../Components/Header/ServicesPanel.vue';
import HeaderTelephone from './HeaderTelephone.vue';

export default {
    name: 'Nav',
    components: { Logo, DesktopNav, MobileNav, ServicesPanel, HeaderTelephone },
    data() {
        return {
            expanded: false,
            panelHover: false,
            isMobileOpen: false
        };
    },
    methods: {
        setExpanded(val) {
            this.expanded = !!val;
            this.$emit('expanded-change', this.expanded);
        },
        openPanel() {
            if (window.innerWidth >= 1024) this.setExpanded(true);
        },
        maybeClosePanel() {
            // Закрываем по клику на триггер вне зависимости от положения курсора
            this.setExpanded(false);
        },
        closePanel() {
            if (window.innerWidth >= 1024) this.setExpanded(false);
        },
        onNavMouseLeave() {
            // Закрываем, когда курсор уходит с полноширинной зоны навигации
            if (window.innerWidth >= 1024) this.setExpanded(false);
        },
        toggleMobile() {
            this.isMobileOpen = !this.isMobileOpen;
        },
        onLinkEnter(e) {
            const el = e.currentTarget;
            el.classList.remove('leaving');
        },
        onLinkLeave(e) {
            const el = e.currentTarget;
            el.classList.add('leaving');
            clearTimeout(el._leavingTimer);
            // 320ms — как в CSS переходе подчёркивания
            el._leavingTimer = setTimeout(() => el.classList.remove('leaving'), 320);
        },
        onTopItemEnter(e) {
            const scope = this.$refs.desktop?.getTopScope?.() || null;
            scope && scope.classList.add('is-hovering');
            const el = e.currentTarget;
            el && el.classList.add('is-current');
            // при наведении на верхние пункты скрываем navbar (десктоп)
            this.closePanel();
        },
        onTopItemLeave(e) {
            const scope = this.$refs.desktop?.getTopScope?.() || null;
            const el = e.currentTarget;
            el && el.classList.remove('is-current');
            if (scope && !scope.querySelector('.menu-link:hover')) {
                scope.classList.remove('is-hovering');
            }
        },
        onPanelItemsHover(isHover) {
            // Затемнять верхние пункты при наведении на элементы панели услуг; «Услуги» остаётся ярким
            const scope = this.$refs.desktop?.getTopScope?.() || null;
            if (!scope) return;
            if (isHover) {
                scope.classList.add('is-hovering');
                const trigger = scope.querySelector('.menu-link');
                trigger && (trigger.classList.add('no-dim'), trigger.classList.add('is-current'));
            } else {
                scope.classList.remove('is-hovering');
                scope.querySelectorAll('.no-dim').forEach(el => el.classList.remove('no-dim'));
                scope.querySelectorAll('.is-current').forEach(el => el.classList.remove('is-current'));
            }
        },
        onPanelLinkEnter() {
            const scope = this.$refs.desktop?.getTopScope?.() || null;
            if (!scope) return;
            scope.querySelectorAll('.menu-link').forEach(el => el.classList.remove('is-current'));
            const trigger = scope.querySelector('.menu-link');
            trigger && trigger.classList.add('is-current');
        },
        onPanelLinkLeave() {
            const scope = this.$refs.desktop?.getTopScope?.() || null;
            if (!scope) return;
            scope.querySelectorAll('.menu-link').forEach(el => el.classList.remove('is-current'));
        }
    }
};
</script>

<style scoped>
/* Базовая высота шапки (не меняется) */
.nav-root {
    position: relative;
    min-height: var(--nav-h);
    overflow: visible;
    --nav-h: 72px;
    --panel-h: 90px; /* ещё на ~20% меньше от 112px */
    /* плавное наращивание высоты контейнера, чтобы толкать контент вниз */
    transition: min-height .42s cubic-bezier(.22, 1, .36, 1);
}

/* Больше не увеличиваем высоту контейнера при раскрытии на десктопе — панель перекрывает контент */
.nav-root.nav--expanded {
    min-height: var(--nav-h);
}

/* Зона навигации объединяет область шапки и панель на ширину экрана */
.nav-zone {
    position: absolute;
    left: 50%;
    transform: translateX(-50%);
    width: 100vw;
    top: 0;
    height: var(--nav-h);
    /* зона покрывает текущую высоту nav-root */
    z-index: 10;
}

/* При раскрытии увеличиваем интерактивную зону, чтобы курсор мог перейти на панель */
.nav-zone.is-expanded {
    height: calc(var(--nav-h) + var(--panel-h));
}

/* Заливка самого navbar (верхняя часть), плавно темнеет */
.nav-top-bg {
    position: absolute;
    left: 50%;
    transform: translateX(-50%);
    width: 100vw;
    /* заливка на всю ширину экрана */
    top: 0;
    height: 100%;
    background: white;
    z-index: 0;
    pointer-events: none;
    /* не блокирует клики по верхним пунктам */
    transition: background-color .42s cubic-bezier(.22, 1, .36, 1);
}

.nav-top-bg.is-expanded {
    background: #232323;
}

/* Фон на всю ширину экрана (100vw), закреплён под шапкой */
.nav-bg {
    position: absolute;
    left: 50%;
    transform: translateX(-50%);
    width: 100vw;
    /* располагаем фон сразу под шапкой, чтобы он раскрывался вниз поверх контента */
    top: var(--nav-h);
    height: 0;
    /* растёт вверх из низа nav-root */
    box-shadow: none;
    z-index: 15;
    transform-origin: top;
    pointer-events: none;
    /* фон никогда не перехватывает клики */
    transition: height .42s cubic-bezier(.22, 1, .36, 1), background-color .42s cubic-bezier(.22, 1, .36, 1), box-shadow .42s cubic-bezier(.22, 1, .36, 1);
}

.nav-bg.is-expanded {
    height: var(--panel-h);
    /* отключаем фон и тень, чтобы не было широкой тёмной полосы под шапкой */
    background: transparent;
    box-shadow: none;
}

/* Внутреннее содержимое шапки всегда поверх фона */
.nav-inner {
    position: relative;
    z-index: 30;
    /* выше панелей и фона, чтобы элементы оставались кликабельными */
    max-width: 1440px;
    /* как .app-container */
    margin: 0 auto;
    padding: 0 24px;
    box-sizing: border-box;
    height: var(--nav-h);
    display: flex;
    align-items: center;
    /* вертикальное центрирование логотипа */
}



/* Инверсия логотипа при тёмном фоне (если это IMG/SVG).
   Исключаем элементы с классом .no-invert (например, иконка телефона). */
.nav--expanded :deep(svg:not(.no-invert)),
.nav--expanded :deep(img:not(.no-invert)) {
    filter: brightness(0) invert(1);
}

/* Стили панели услуг перенесены в компонент ServicesPanel.vue */

/* Подчёркивание для пунктов меню вынесено в global: resources/css/app.css (.menu-link) */

/* Мобильное меню: анимация выезда справа налево */
.mobile-menu {
    background: #232323;
    transform: translateX(100%);
    opacity: 0;
    transition: transform .32s cubic-bezier(.22, 1, .36, 1), opacity .24s ease;
}

.mobile-menu.is-open {
    transform: translateX(0);
    opacity: 1;
}
</style>