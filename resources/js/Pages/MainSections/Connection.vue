<template>
  <section id="connection"
    class="bg-blue-500 pt-10 pb-6 sm:pt-16 sm:pb-8 lg:pt-16 lg:pb-16 scroll-animate overflow-x-hidden"
    :class="{ 'in-view': inView }">
    <div class="mx-auto w-full max-w-[1440px] px-4 sm:px-6 lg:px-8">
      <div id="contact-toggle-area" :aria-controls="collapsibleId"
        class="relative w-full flex items-center md:items-start justify-center md:justify-center mb-2 md:mb-6 select-none pr-0 md:pr-0"
        :role="!isLarge ? 'button' : undefined" :tabindex="!isLarge ? 0 : undefined"
        :aria-expanded="!isLarge ? String(isOpen) : undefined" @click="!isLarge && onHeaderToggleClick($event)"
        @keydown.enter.prevent="!isLarge && toggleOpen()" @keydown.space.prevent="!isLarge && toggleOpen()">
        <h2 data-reveal data-reveal-delay="0"
          class="text-center font-montserrat text-3xl md:text-4xl font-extrabold text-gray-200">
          <span class="block sm:inline">СВЯЗАТЬСЯ</span>
          <span class="block sm:inline">&nbsp;С&nbsp;НАМИ</span>
        </h2>

        <button id="contact-collapse-toggle" type="button" :aria-expanded="String(isOpen)"
          :aria-controls="collapsibleId"
          class="absolute right-0 top-1/2 -translate-y-1/2 md:static md:translate-y-0 md:mt-1 inline-flex items-center justify-center w-10 h-10 text-gray-100 transition md:ml-6 lg:ml-0 lg:hidden"
          title="Показать/скрыть форму" @click.stop="toggleOpen()">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
            class="chevron transition-transform duration-300 ease-out w-16 h-16 text-white -translate-y-1" fill="none"
            stroke="currentColor" stroke-width="3" aria-hidden="true" :class="{ 'rotate-180': isOpen }">
            <path d="M6 9l6 6 6-6" />
          </svg>
        </button>
      </div>

      <div :id="collapsibleId" class="mobile-collapsible md:max-h-none md:opacity-100 md:pointer-events-auto"
        :data-open="String(isOpen)">
        <p class="max-w-2xl mx-auto text-center text-gray-100/90 font-open-sans text-base md:text-lg mb-6 md:mb-8"
          data-reveal data-reveal-delay="120">
          Оставьте свои контактные данные, и мы свяжемся с вами в удобное время.
        </p>

        <ContactForm :action="action" />
      </div>
    </div>
  </section>
</template>

<script setup>
import { onMounted, onBeforeUnmount, ref, watch } from 'vue'
import ContactForm from './Partials/ContactForm.vue'

const props = defineProps({
  action: { type: String, default: '/contact' },
  initialOpen: { type: Boolean, default: false },
})

const collapsibleId = 'contact-collapsible'
const inView = ref(false)
const isLarge = ref(false)
const isOpen = ref(false)
let mql = null

function updateIsLarge() {
  isLarge.value = window.matchMedia('(min-width: 1024px)').matches
}

watch(isLarge, (val) => {
  // На >=1024 всегда открыто
  if (val) isOpen.value = true
})

function toggleOpen() {
  if (isLarge.value) return
  isOpen.value = !isOpen.value
}

function onHeaderToggleClick(e) {
  const btn = (e.target.closest && e.target.closest('#contact-collapse-toggle'))
  if (btn) return
  toggleOpen()
}

// Scroll reveal
let io = null
onMounted(() => {
  updateIsLarge()
  isOpen.value = isLarge.value ? true : !!props.initialOpen
  mql = window.matchMedia('(min-width: 1024px)')
  const onMql = () => updateIsLarge()
  mql.addEventListener('change', onMql)
  // Reveal observer
  if ('IntersectionObserver' in window) {
    io = new IntersectionObserver((entries, obs) => {
      entries.forEach(en => {
        if (en.isIntersecting) {
          inView.value = true
          obs.disconnect()
        }
      })
    }, { threshold: 0.2 })
    const el = document.getElementById('connection')
    el && io.observe(el)
  } else {
    setTimeout(() => (inView.value = true), 150)
  }
})

onBeforeUnmount(() => {
  if (io) io.disconnect()
  try { mql && mql.removeEventListener('change', updateIsLarge) } catch { }
})

// form is encapsulated in ContactForm component
</script>

<style scoped>
/* Collapsible */
.mobile-collapsible {
  transition: max-height .5s cubic-bezier(.4, 0, .2, 1), opacity .35s ease;
  overflow: hidden;
}

.mobile-collapsible[data-open="false"] {
  max-height: 0;
  opacity: 0;
  pointer-events: none;
}

.mobile-collapsible[data-open="true"] {
  max-height: 4000px;
  opacity: 1;
}

/* Scroll reveal справа налево */
.scroll-animate {
  opacity: 0;
  transform: translateX(80px);
  transition: opacity .8s ease, transform .8s cubic-bezier(.25, .8, .25, 1);
}

.scroll-animate.in-view {
  opacity: 1;
  transform: translateX(0);
}

/* Errors */
.field-error[data-error-active="true"] {
  position: relative;
  display: inline-block;
  background: #dc2626;
  color: #fff;
  padding: 4px 10px 5px;
  border-radius: 6px;
  font-weight: 500;
  line-height: 1.2;
  box-shadow: 0 4px 10px -2px rgba(0, 0, 0, .25);
}

.field-error[data-error-active="true"]:before {
  content: "";
  position: absolute;
  top: -6px;
  left: 14px;
  width: 0;
  height: 0;
  border-left: 6px solid transparent;
  border-right: 6px solid transparent;
  border-bottom: 6px solid #dc2626;
}

/* Inputs */
.field-input {
  border-width: 0 0 1px 0;
  transition: border-color .25s ease, border-bottom-width .25s ease;
  position: relative;
}

.field-input.error {
  border-bottom: 2px solid #ef4444 !important;
}

.field-input::placeholder {
  color: rgba(255, 255, 255, 0.75);
  opacity: 1;
  transition: opacity .30s ease, color .30s ease;
}

.field-input:focus::placeholder {
  opacity: 0;
}

/* Focus bounce */
@keyframes fieldBounce {
  0% {
    transform: translateY(0);
  }

  30% {
    transform: translateY(-4px);
  }

  55% {
    transform: translateY(0);
  }

  100% {
    transform: translateY(0);
  }
}

.field-input:focus {
  animation: fieldBounce .40s cubic-bezier(.34, 1.56, .64, 1);
}

/* Date input + placeholder */
.date-wrapper {
  position: relative;
}

.date-wrapper input[type="text"] {
  position: relative;
  z-index: 2;
  background: transparent;
}

.date-ph {
  position: absolute;
  left: 0;
  top: 50%;
  transform: translateY(-50%);
  font-weight: 600;
  font-size: 0.875rem;
  line-height: 1;
  pointer-events: none;
  color: rgba(255, 255, 255, 0.75);
  transition: opacity .05s linear;
}

.date-wrapper.pre-activate .date-ph,
.date-wrapper.focus .date-ph,
.date-wrapper[data-has-value="true"] .date-ph {
  opacity: 0;
}

.date-calendar-btn {
  z-index: 3;
  background: transparent;
  color: #fff;
}

.date-calendar-btn:focus {
  outline: none;
}
</style>