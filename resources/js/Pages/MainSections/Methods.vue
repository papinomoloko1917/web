<template>
  <section class="mt-5 pt-10 lg:pt-10">
    <div class="app-container">
      <div class="text-center mb-8">
        <h2 id="services-heading"
            class="font-montserrat text-3xl md:text-4xl lg:text-4xl font-extrabold text-gray-800 mb-2 transition-all duration-700 ease-out opacity-0 translate-x-8 will-change-transform will-change-opacity">
          ЭТАПЫ РАБОТ
        </h2>
      </div>

      <div class="pt-6 max-w-full mx-auto">
  <div id="work-accordion" class="w-full" role="tablist" aria-label="ЭТАПЫ РАБОТ" :class="{ 'has-hover': hoverState.any }">
    <div v-for="(item, idx) in items" :key="idx"
      class="accordion-wrapper font-open-sans text-lg overflow-hidden transition-all duration-500 ease-out opacity-0 translate-x-8 will-change-transform will-change-opacity border-t border-l border-gray-300"
               :data-delay="120 * idx">
            <h3>
        <button type="button"
          class="text-gray-800 font-montserrat text-lg lg:text-2xl accordion-btn w-full flex items-center justify-between px-5 py-5 lg:py-6 text-left bg-[#FAFAFA] hover:bg-gray-50 focus:outline-none"
          :class="{ 'is-hover': hoverState.current === idx }"
                      :aria-controls="`panel-${idx}`"
                      :aria-expanded="String(openIndex === idx)"
                      @click="onToggle(idx)"
                      @pointerenter="onHover(idx, true)"
                      @pointerleave="onHover(idx, false)"
                      @focus="onHover(idx, true)"
                      @blur="onHover(idx, false)">
                <span class="accordion-title transition-colors duration-300 font-semibold"
                      :class="{ 'text-blue-600': openIndex === idx }">
                  {{ item.title }}
                </span>
                <svg class="icon w-7 h-7 lg:w-9 lg:h-9" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
              </button>
            </h3>
      <div :id="`panel-${idx}`" role="region" :aria-labelledby="`tab-${idx}`" class="overflow-hidden"
        ref="panels"
        :data-index="idx">
              <div class="panel-inner px-4 py-3">{{ item.content }}</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { onMounted, onBeforeUnmount, reactive, ref } from 'vue'

const items = [
  { title: '1. Обследование объекта', content: 'Осмотр объекта, замеры, изучение проектной документации смежных разделов и сбор всей информации для расчета сметы и составления плана работ' },
  { title: '2. Согласование', content: 'Утверждение сметы, сроков и материалов. Подписание договора и согласование деталей. Предоплата только за материалы.' },
  { title: '3. Производство работ', content: 'Выполнение работ согласно договору, технического задания, сметы и нормативных документов.' },
  { title: '4. Сдача', content: 'Приёмка работ, передача документации и финальная оплата после сдачи работ.' },
]

const openIndex = ref(-1)
const panels = ref([])
const hoverState = reactive({ any: false, current: -1 })

function onToggle(idx) {
  const wasOpen = openIndex.value === idx
  const newIdx = wasOpen ? -1 : idx
  // close previously open
  if (openIndex.value !== -1 && openIndex.value !== idx) {
    const p = getPanel(openIndex.value)
    p && closePanel(p)
  }
  if (wasOpen) {
    const p = getPanel(idx)
    p && closePanel(p)
    openIndex.value = -1
  } else {
    openIndex.value = idx
    const p = getPanel(idx)
    p && openPanel(p)
  }
}

function onHover(idx, isOn) {
  hoverState.current = isOn ? idx : -1
  hoverState.any = isOn
}

function getPanel(idx) {
  const list = panels.value
  if (!list) return null
  // panels may not be strictly ordered; find by data-index
  return list.find(el => el?.dataset?.index === String(idx)) || null
}

function openPanel(panel) {
  if (!panel) return
  if (panel.dataset.animating === 'opening') return
  panel.dataset.animating = 'opening'
  panel.style.display = ''
  panel.style.pointerEvents = 'none'
  panel.style.willChange = 'max-height'
  const startHeight = parseFloat(getComputedStyle(panel).maxHeight) || 0
  panel.style.maxHeight = startHeight + 'px'
  // Принудительный reflow, чтобы браузер зафиксировал начальное значение и запустил переход
  panel.getBoundingClientRect()
  const target = panel.scrollHeight + 1
  requestAnimationFrame(() => { panel.style.maxHeight = target + 'px' })
  const onEnd = (e) => {
    if (e.target === panel && e.propertyName === 'max-height') {
      panel.style.maxHeight = ''
      panel.dataset.animating = 'idle'
      panel.style.pointerEvents = ''
      panel.style.willChange = 'auto'
      panel.removeEventListener('transitionend', onEnd)
    }
  }
  panel.addEventListener('transitionend', onEnd)
}

function closePanel(panel) {
  if (!panel) return
  if (panel.dataset.animating === 'closing') return
  panel.dataset.animating = 'closing'
  panel.style.pointerEvents = 'none'
  panel.style.willChange = 'max-height'
  const current = panel.scrollHeight
  panel.style.maxHeight = current + 'px'
  panel.getBoundingClientRect()
  requestAnimationFrame(() => { panel.style.maxHeight = '0px' })
  const onEnd = (e) => {
    if (e.target === panel && e.propertyName === 'max-height') {
      panel.style.display = 'none'
      panel.style.maxHeight = ''
      panel.dataset.animating = 'idle'
      panel.style.pointerEvents = ''
      panel.style.willChange = 'auto'
      panel.removeEventListener('transitionend', onEnd)
    }
  }
  panel.addEventListener('transitionend', onEnd)
}

// Больше не возвращаем inline-стили, инициализируем стартовое состояние в onMounted

// Reveal-on-scroll for heading and wrappers
let io
onMounted(() => {
  const heading = document.getElementById('services-heading')
  const wrappers = Array.from(document.querySelectorAll('#work-accordion .accordion-wrapper'))
  if (heading && !heading.classList.contains('opacity-0')) {
    heading.classList.add('opacity-0', 'translate-x-8')
  }
  wrappers.forEach(el => {
    if (!el.classList.contains('opacity-0')) el.classList.add('opacity-0', 'translate-x-8')
  })
  const reduce = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches
  const showInstant = (el) => {
    el.classList.remove('opacity-0', 'translate-x-8')
    el.classList.add('opacity-100', 'translate-x-0')
    el.dataset.animated = '1'
  }
  if (reduce) {
    if (heading) showInstant(heading)
    wrappers.forEach(showInstant)
  } else {
    const obs = new IntersectionObserver((entries, obs) => {
      entries.forEach(entry => {
        if (!entry.isIntersecting) return
        const el = entry.target
        if (el.dataset.animated === '1') { obs.unobserve(el); return }
        const baseDelay = 60
        const delay = Number(el.getAttribute('data-delay') || 0) + baseDelay
        el.style.willChange = 'transform, opacity'
        setTimeout(() => {
          el.classList.remove('opacity-0', 'translate-x-8')
          el.classList.add('opacity-100', 'translate-x-0')
          el.dataset.animated = '1'
          setTimeout(() => { el.style.willChange = 'auto' }, 500)
        }, delay)
        obs.unobserve(el)
      })
    }, { threshold: 0.18 })
    io = obs
    if (heading) obs.observe(heading)
    wrappers.forEach(el => obs.observe(el))
  }

  // Инициализируем панели в закрытом состоянии, чтобы последующее open/close было плавным
  const panelEls = Array.from(document.querySelectorAll('#work-accordion [role="region"]'))
  panelEls.forEach((panel) => {
    // Сразу скрываем без анимации
    panel.style.transition = 'none'
    panel.style.maxHeight = '0px'
    panel.style.display = 'none'
    // Возвращаем транзишн после короткого тикка
    requestAnimationFrame(() => {
      panel.style.transition = ''
    })
  })
})

onBeforeUnmount(() => { if (io) io.disconnect() })
</script>

<style scoped>
/* Cursor for buttons */
.accordion-btn { cursor: pointer; }

/* Icon rotate to × when expanded */
.accordion-btn[aria-expanded="true"] .icon { transform: rotate(45deg); }
.icon {
  transition: transform 220ms cubic-bezier(.2,.9,.2,1),
              color 520ms cubic-bezier(.2,.6,.2,1),
              stroke 520ms cubic-bezier(.2,.6,.2,1);
  transform-origin: center center;
  transform-box: fill-box;
  display: inline-block;
  will-change: transform, color, stroke;
}

/* Hover dimming within container */
#work-accordion.has-hover .accordion-btn:not(.is-hover):not([aria-expanded="true"]) .accordion-title,
#work-accordion.has-hover .accordion-btn:not(.is-hover):not([aria-expanded="true"]) .icon {
  color: rgb(156 163 175); /* text-gray-400 */
  transition-delay: 40ms;
}
#work-accordion .accordion-btn.is-hover { color: rgb(31 41 55); /* text-gray-800 */ }
#work-accordion .accordion-btn[aria-expanded="true"],
#work-accordion .accordion-btn[aria-expanded="true"] .accordion-title,
#work-accordion .accordion-btn[aria-expanded="true"] .icon { color: rgb(37 99 235); }

/* Wrapper clickable and light bg */
#work-accordion .accordion-wrapper { cursor: pointer; background: #FAFAFA; position: relative; margin-bottom: 10px; }
#work-accordion .accordion-wrapper:last-child { margin-bottom: 0; }

/* Smooth panel expand/collapse */
#work-accordion [role="region"] {
  overflow: hidden;
  will-change: max-height;
  transition: max-height 320ms cubic-bezier(.2,.9,.2,1);
  contain: layout paint;
}
</style>
