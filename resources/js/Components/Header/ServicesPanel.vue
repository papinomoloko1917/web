<template>
    <!-- Выдвижная панель услуг -->
    <div class="nav-panel" :class="{ 'is-expanded': expanded }" @mouseenter="$emit('panel-hover', true)"
        @mouseleave="$emit('panel-hover', false)">
        <div class="panel-inner">
            <div class="services-grid hover-scope" ref="scope">
                <a v-for="svc in services" :key="svc.href" :href="svc.href" class="service-link menu-link"
                    @mouseenter="onItemEnter(svc, $event)" @mouseleave="onItemLeave(svc, $event)">{{ svc.title }}</a>
            </div>
        </div>
    </div>
</template>

<script>
import { servicesLinks as defaultServices } from '../../data/nav.js';
export default {
    name: 'ServicesPanel',
    props: {
        expanded: { type: Boolean, default: false },
        // Если список услуг не передан, используем дефолтный
        services: {
            type: Array,
            default: () => defaultServices.map(s => ({ title: s.label, href: s.href }))
        }
    },
    methods: {
        onItemEnter(item, e) {
            const scope = this.$refs.scope;
            scope && scope.classList.add('is-hovering');
            // отметить текущий
            const el = e.currentTarget;
            if (el) {
                el.classList.remove('leaving'); // убрать leaving, если был
                el.classList.add('is-current');
            }
            // прокинуть наружу детальный эвент
            this.$emit('link-enter', { item, event: e });
            this.$emit('item-hover', true);
        },
        onItemLeave(item, e) {
            const scope = this.$refs.scope;
            const el = e.currentTarget;
            if (el) {
                el.classList.remove('is-current');
                // добавить класс leaving, чтобы transform-origin сменился на right center
                el.classList.add('leaving');
                // удалить leaving после завершения анимации (320ms — совпадает с transition)
                setTimeout(() => {
                    el.classList.remove('leaving');
                }, 320);
            }
            // прокинуть наружу детальный эвент
            this.$emit('link-leave', { item, event: e });
            // если ни один .menu-link не ховерится, снять класс с контейнера
            if (scope && !scope.querySelector('.menu-link:hover')) {
                scope.classList.remove('is-hovering');
                this.$emit('item-hover', false);
            } else {
                this.$emit('item-hover', true);
            }
        }
    }
};
</script>

<style scoped>
.nav-panel {
    position: absolute;
    left: 50%;
    transform: translateX(-50%);
    width: 100vw;
    top: var(--nav-h);
    height: 0;
    overflow: hidden;
    pointer-events: none;
    z-index: 20;
    transition: height .28s ease;
    color: #e5e7eb;
}

.nav-panel.is-expanded {
    height: var(--panel-h);
    pointer-events: auto;
}

.panel-inner {
    max-width: 1440px;
    margin: 0 auto;
    padding: 0 24px;
    box-sizing: border-box;
    height: 100%;
    display: flex;
    align-items: center;
}

.services-grid {
    width: 100%;
    display: flex;
    flex-wrap: nowrap;
    gap: 50px;
    align-items: center;
    justify-content: center;
    transition: height .42s cubic-bezier(.22, 1, .36, 1);
    opacity: 0;
    transform: translateY(8px);
    transition: opacity .22s ease, transform .24s ease;
}

.nav-panel.is-expanded .services-grid {
    opacity: 1;
    transform: none;
    transition-delay: 60ms;
}

.service-link {
    color: inherit;
    font-weight: 400;
    padding: 8px 0;
    display: inline-block;
    transition: color .2s ease, opacity .2s ease;
}

.service-link:hover {
    opacity: .85;
}
</style>
