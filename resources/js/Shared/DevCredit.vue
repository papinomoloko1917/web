<template>
    <div class="dev-credit" :class="{ 'is-filled': filled, 'leaving': leaving }" @mouseenter="enter" @mouseleave="leave"
        role="presentation">
        <span class="dev-label">
            <slot>&lt;/&gt; Разработка: ninjamax</slot>
        </span>
    </div>
</template>

<script setup>
import { ref } from 'vue'

const duration = 320 // ms, согласовать с вашим CSS таймингом

const filled = ref(false)
const leaving = ref(false)
let _leaveTimer = null

function enter() {
    leaving.value = false
    filled.value = true
    clearTimeout(_leaveTimer)
}

function leave() {
    filled.value = false
    leaving.value = true
    clearTimeout(_leaveTimer)
    _leaveTimer = setTimeout(() => {
        leaving.value = false
    }, duration)
}
</script>

<style scoped>
.dev-credit {
    position: relative;
    display: inline-block;
    padding: 2px 6px;
    border-radius: 3px;
    color: #6b7280;
    /* text-gray-500 */
    -webkit-tap-highlight-color: transparent;
}

/* текст поверх заливки */
.dev-credit .dev-label {
    position: relative;
    z-index: 2;
    transition: color .18s ease;
}

/* заливка за текстом */
.dev-credit::before {
    content: "";
    position: absolute;
    left: 0;
    top: 0;
    bottom: 0;
    width: 100%;
    background: rgba(236, 10, 10, 0.61);
    /* тонкая заливка */
    transform: scaleX(0);
    transform-origin: left center;
    transition: transform .32s cubic-bezier(.22, 1, .36, 1);
    will-change: transform;
    z-index: 1;
}

/* при заполнении — раскрываем слева→направо */
.dev-credit.is-filled::before {
    transform: scaleX(1);
    transform-origin: left center;
}

/* при уходе — сжимаем слева направо (origin справа) */
.dev-credit.leaving::before {
    transform: scaleX(0);
    transform-origin: right center;
}

/* опционально изменяем цвет текста при заполнении */
.dev-credit.is-filled .dev-label {
    color: #e6eefc;
}
</style>