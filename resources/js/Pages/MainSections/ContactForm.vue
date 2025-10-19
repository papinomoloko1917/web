<template>
  <div>
    <div v-if="status.message" class="max-w-xl mx-auto mb-6" :class="status.ok ? 'bg-green-600/90 text-white' : 'bg-red-600/90 text-white'" role="status">
      {{ status.message }}
    </div>

    <form :action="action" method="POST" class="contact-form max-w-xl mx-auto grid gap-5" @submit.prevent="onSubmit" novalidate>
      <div class="contact-msg-wrapper space-y-3" aria-live="polite"></div>

      <div class="grid gap-2">
        <input id="contact-name" name="name" type="text" required maxlength="120"
               v-model.trim="form.name"
               class="font-semibold field-input w-full bg-transparent text-white appearance-none border-b border-white/90 focus:border-white focus:outline-none transition px-0 py-2"
               placeholder="Ваше имя*" aria-describedby="error-name" :aria-invalid="errors.name ? 'true' : undefined"
        />
        <p id="error-name" data-error-for="name" class="field-error text-xs min-h-[1.25rem]" :data-error-active="errors.name ? 'true' : null">{{ errors.name }}</p>
      </div>

      <div class="grid gap-2">
        <input id="contact-phone" name="phone" type="tel" required maxlength="40"
               ref="phoneRef"
               v-model="form.phone"
               class="field-input w-full bg-transparent font-semibold text-white appearance-none border-b border-white/90 focus:border-white focus:outline-none transition px-0 py-2"
               placeholder="Телефон*" aria-describedby="error-phone" :aria-invalid="errors.phone ? 'true' : undefined"
               @focus="onPhoneFocus" @input="onPhoneInput" @keydown="onPhoneKeydown" @blur="onPhoneBlur"
        />
        <p id="error-phone" data-error-for="phone" class="field-error text-xs min-h-[1.25rem]" :data-error-active="errors.phone ? 'true' : null">{{ errors.phone }}</p>
      </div>

      <div class="grid gap-2">
        <div class="date-wrapper relative" :data-has-value="dateMasked ? 'true' : 'false'" :class="{ 'pre-activate': datePreActivate, 'focus': dateFocus }">
          <input id="contact-date" name="date-mask" type="text"
                 inputmode="numeric" autocomplete="off"
                 class="field-input date-input w-full bg-transparent font-semibold text-white appearance-none border-b border-white/90 focus:border-white focus:outline-none transition px-0 py-2"
                 :value="dateMasked" @focus="onDateFocus" @blur="onDateBlur" @input="onDateInput" @keydown.backspace.prevent="onDateBackspace"
                 placeholder=""
                 aria-describedby="error-date"
          />
          <span class="date-ph select-none">Дата</span>
          <button type="button" class="date-calendar-btn absolute inset-y-0 right-0 flex items-center justify-center px-0" aria-label="Открыть календарь" tabindex="-1" @click.prevent="openNativePicker">
            <svg viewBox="0 0 24 24" class="w-6 h-6 text-white opacity-80 hover:opacity-100 transition" fill="none" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
              <rect x="3" y="4" width="18" height="18" rx="2" ry="2" />
              <line x1="16" y1="2" x2="16" y2="6" />
              <line x1="8" y1="2" x2="8" y2="6" />
              <line x1="3" y1="10" x2="21" y2="10" />
            </svg>
          </button>
          <!-- hidden native date for mobile pickers; kept in sync -->
          <input ref="nativeDateRef" type="date" class="hidden" tabindex="-1" @change="onNativeDateChange" />
        </div>
        <p id="error-date" data-error-for="date" class="field-error text-xs min-h-[1.25rem]" :data-error-active="errors.date ? 'true' : null">{{ errors.date }}</p>
      </div>

      <div class="pt-2">
        <button type="submit" :disabled="loading"
                class="submit-btn inline-flex items-center justify-center w-full rounded-4xl bg-[#232323] text-gray-100 font-montserrat font-semibold tracking-wide px-6 py-3 hover:rounded-none focus:outline-none transition-all duration-400 cursor-pointer disabled:opacity-60 disabled:cursor-not-allowed">
          <span class="btn-text">{{ loading ? 'Отправка...' : 'Отправить' }}</span>
          <span class="btn-spinner" :class="['ml-2 h-5 w-5 border-2 border-white/70 border-t-transparent rounded-full animate-spin', loading ? 'inline-block' : 'hidden']"></span>
        </button>
      </div>

      <p class="text-[13px] leading-snug text-gray-100/80 mt-1">
        Нажимая «Отправить», вы соглашаетесь с обработкой
        <a href="/privacy" target="_blank" rel="noopener noreferrer" class="underline hover:text-white">персональных данных</a>.
      </p>
    </form>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { formatPhoneMask, isPhoneComplete, backspacePhoneAtPosition, formatDateMaskedFromDigits, normalizeDateFromMasked, isDateMaskedComplete } from '../../data/useContactMasks'

const props = defineProps({
  action: { type: String, default: '/contact' },
})

// Form state
const form = ref({ name: '', phone: '' })
const dateMasked = ref('')
const errors = ref({ name: '', phone: '', date: '' })
const status = ref({ ok: false, message: '' })
const loading = ref(false)

// Phone
const phoneRef = ref(null)
function onPhoneFocus() {
  if (!form.value.phone.trim()) {
    form.value.phone = formatPhoneMask('')
    requestAnimationFrame(() => {
      const el = phoneRef.value
      if (!el) return
      let pos = el.value.indexOf('_')
      if (pos === -1) pos = el.value.length
      el.setSelectionRange(pos, pos)
    })
  }
}
function onPhoneInput(e) {
  const el = e.target
  const digits = el.value.replace(/\D/g, '')
  form.value.phone = formatPhoneMask(digits)
  const firstUnderscore = form.value.phone.indexOf('_')
  if (firstUnderscore !== -1) {
    requestAnimationFrame(() => el.setSelectionRange(firstUnderscore, firstUnderscore))
  }
  if (errors.value.phone && digits.length >= 6) errors.value.phone = ''
}
function onPhoneKeydown(e) {
  if (e.key === 'Backspace') {
    const el = e.target
    const start = el.selectionStart
    const { value, pos } = backspacePhoneAtPosition(el.value, start)
    el.value = value
    form.value.phone = value
    el.setSelectionRange(pos, pos)
    e.preventDefault()
  }
}
function onPhoneBlur() {
  if (!isPhoneComplete(form.value.phone) || form.value.phone === formatPhoneMask('')) {
    form.value.phone = ''
  }
}

// Date
const datePreActivate = ref(false)
const dateFocus = ref(false)
const nativeDateRef = ref(null)
function onDateFocus() {
  dateFocus.value = true
  if (!dateMasked.value) datePreActivate.value = true
}
function onDateBlur() {
  dateFocus.value = false
  if (!isDateMaskedComplete(dateMasked.value)) {
    dateMasked.value = ''
    datePreActivate.value = false
  }
}
function onDateInput(e) {
  const raw = e.target.value
  const digits = raw.replace(/\D/g, '')
  dateMasked.value = formatDateMaskedFromDigits(digits)
}
function onDateBackspace(e) {
  const el = e.target
  const pos = el.selectionStart
  let val = dateMasked.value
  for (let i = pos - 1; i >= 0; i--) {
    if (/\d|_/.test(val[i])) {
      const arr = val.split('')
      arr[i] = '_'
      val = arr.join('')
      break
    }
  }
  const only = val.replace(/\D/g, '')
  dateMasked.value = formatDateMaskedFromDigits(only)
  requestAnimationFrame(() => {
    const newPos = (function() {
      for (let i = pos - 1; i >= 0; i--) if (/\d|_/.test(el.value[i])) return i
      return pos
    })()
    el.setSelectionRange(newPos, newPos)
  })
}
function openNativePicker() {
  const el = nativeDateRef.value
  if (!el) return
  if (typeof el.showPicker === 'function') el.showPicker()
  else el.focus()
}
function onNativeDateChange(e) {
  const v = e.target.value
  if (!v) return
  const [y, m, d] = v.split('-')
  dateMasked.value = `${d}.${m}.${y}`
}

function setFieldError(field, message) { errors.value[field] = message }
function clearFieldErrors() { errors.value = { name: '', phone: '', date: '' } }

async function onSubmit() {
  status.value = { ok: false, message: '' }
  clearFieldErrors()
  if (!form.value.name.trim()) setFieldError('name', 'Укажите имя')
  if (!isPhoneComplete(form.value.phone)) setFieldError('phone', 'Заполните номер полностью')
  // date optional; normalize if present
  if (errors.value.name || errors.value.phone) return

  loading.value = true
  try {
    const fd = new FormData()
    fd.set('name', form.value.name.trim())
    fd.set('phone', (form.value.phone || '').replace(/_/g, '').replace(/\s+/g, ' '))
    const normalized = normalizeDateFromMasked(dateMasked.value)
    if (normalized) fd.set('date', normalized)
    const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
    const res = await fetch(props.action, { method: 'POST', headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json', 'X-CSRF-TOKEN': token }, body: fd })
    let data = {}
    try { data = await res.json() } catch {}
    if (!res.ok) {
      if (data && data.errors) {
        Object.entries(data.errors).forEach(([field, messages]) => { setFieldError(field, messages?.[0] || 'Ошибка') })
      }
      status.value = { ok: false, message: data?.message || 'Произошла ошибка. Повторите позже.' }
    } else {
      status.value = { ok: true, message: data?.message || 'Заявка отправлена.' }
      form.value = { name: '', phone: '' }
      dateMasked.value = ''
    }
  } catch (e) {
    status.value = { ok: false, message: 'Сеть недоступна. Проверьте соединение.' }
  } finally {
    loading.value = false
  }
}
</script>

<style scoped>
/* Errors bubble with arrow */
.field-error[data-error-active="true"] { position: relative; display: inline-block; background: #dc2626; color:#fff; padding:4px 10px 5px; border-radius:6px; font-weight:500; line-height:1.2; box-shadow:0 4px 10px -2px rgba(0,0,0,.25); }
.field-error[data-error-active="true"]:before { content:""; position:absolute; top:-6px; left:14px; width:0; height:0; border-left:6px solid transparent; border-right:6px solid transparent; border-bottom:6px solid #dc2626; }

/* Inputs base */
.field-input { border-width: 0 0 1px 0; transition: border-color .25s ease, border-bottom-width .25s ease; position: relative; }
.field-input.error { border-bottom: 2px solid #ef4444 !important; }
.field-input::placeholder { color: rgba(255,255,255,0.75); opacity: 1; transition: opacity .30s ease, color .30s ease; }
.field-input:focus::placeholder { opacity: 0; }

/* Date input + placeholder */
.date-wrapper { position: relative; }
.date-wrapper input[type="text"] { position: relative; z-index: 2; background: transparent; }
.date-ph { position: absolute; left: 0; top: 50%; transform: translateY(-50%); font-weight: 600; font-size: 0.875rem; line-height: 1; pointer-events: none; color: rgba(255,255,255,0.75); transition: opacity .05s linear; }
.date-wrapper.pre-activate .date-ph, .date-wrapper.focus .date-ph, .date-wrapper[data-has-value="true"] .date-ph { opacity: 0; }
.date-calendar-btn { z-index: 3; background: transparent; color: #fff; }
.date-calendar-btn:focus { outline: none; }
</style>