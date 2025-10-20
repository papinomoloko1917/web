<template>
    <div class="relative" @mouseenter="onMouseEnter" @mouseleave="onMouseLeave">
        <button @click="toggleDropdown"
            class="text-current menu-link menu-link--short-underline services-trigger cursor-pointer"
            :class="{ 'leaving': isLeaving }">
            Услуги
            <svg id="chev-services" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                class="chevron w-4 h-4 ml-1 self-center inline-block transform duration-300"
                :class="{ 'rotate-180': expanded || isDropdownOpen }" aria-hidden="true" focusable="false">
                <path stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    d="m19.5 8.25-7.5 7.5-7.5-7.5" />
            </svg>
        </button>
    </div>
</template>

<script>
export default {
    props: {
        expanded: { type: Boolean, default: false }
    },
    data() {
        return {
            isDropdownOpen: false,
            isLeaving: false
        };
    },
    watch: {
        expanded(val) {
            if (!val) {
                // если navbar свернули — закрыть локально и показать retract вправо
                if (this.isDropdownOpen) {
                    this.isLeaving = true;
                    setTimeout(() => (this.isLeaving = false), 320);
                }
                this.isDropdownOpen = false;
            }
        }
    },
    methods: {
        toggleDropdown() {
            if (this.isDropdownOpen) {
                // закрытие по клику — показать retract вправо
                this.isLeaving = true;
                setTimeout(() => (this.isLeaving = false), 320);
                this.isDropdownOpen = false;
                this.$emit('close');
            } else {
                this.isLeaving = false;
                this.isDropdownOpen = true;
                this.$emit('open');
            }
        },
        onMouseEnter() {
            // на десктопе открываем по hover
            if (window.innerWidth >= 1024) {
                if (this.expanded) return;
                this.isLeaving = false;
                this.isDropdownOpen = true;
                this.$emit('open');
            }
        },
        onMouseLeave() {
            if (window.innerWidth >= 1024) {
                if (this.expanded) return;
                // при уходе показываем retract вправо
                this.isLeaving = true;
                this.isDropdownOpen = false;
                // удаляем leaving после анимации, чтобы не оставался класс
                setTimeout(() => (this.isLeaving = false), 320);
                // На десктопе не отправляем close, чтобы не было мерцания при переходе на панель
            }
        }
    }
};
</script>

<style scoped></style>