<template>
  <div class="layout-root">
    <!-- header с бордером во всю ширину -->
    <header
      :class="['w-full transition-colors duration-300', expanded ? 'border-0 bg-[#232323]' : 'border-b border-gray-500 bg-white']">
      <div class="app-container">
        <Nav @expanded-change="expanded = $event" />
      </div>
    </header>

    <!-- Спейсер под шапкой: толкает контент вниз, когда раскрыта панель услуг (только на десктопе) -->
    <div
      aria-hidden="true"
      class="hidden lg:block w-full transition-[height] duration-300 ease-out"
      :style="{ height: expanded ? '140px' : '0px' }"
    />

    <main class="flex-1">
      <div class="app-container content-wrapper">
        <slot />
      </div>
    </main>

    <footer>
      <Footer />
    </footer>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import Nav from '../Shared/Nav.vue';
import Footer from '../Shared/Footer.vue';

const expanded = ref(false);
</script>

<style></style>