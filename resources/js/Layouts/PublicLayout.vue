<template>
  <div class="layout-root overflow-x-hidden">
    <!-- header с бордером во всю ширину -->
    <header
      :class="['relative z-40 w-full transition-colors duration-300', expanded ? 'border-0 bg-[#232323]' : 'border-b border-gray-500 bg-white']">
      <!-- Убираем внешний .app-container: сам Nav содержит внутренний контейнер .nav-inner -->
      <Nav @expanded-change="expanded = $event" />
    </header>

    <!-- Убрали спейсер: панель услуг теперь накрывает контент на десктопе, не смещая его -->

    <main class="flex-1">
      <!-- Оставляем только вертикальные отступы контента, без вложенного .app-container,
           чтобы секции сами управляли шириной через собственные .app-container -->
      <div class="content-wrapper">
        <slot />
      </div>
    </main>

    <!-- Back to top button -->
    <BackToTop />

    <footer>
      <Footer />
    </footer>
  </div>
  
</template>

<script setup>
import { ref } from 'vue';
import Nav from '../Shared/Nav.vue';
import Footer from '../Shared/Footer.vue';
import BackToTop from '../Components/BackToTop.vue';

const expanded = ref(false);
</script>

<style></style>