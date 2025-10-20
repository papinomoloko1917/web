<template>
  <div class="layout-root">
    <!-- header с бордером во всю ширину -->
    <header
      :class="['relative z-40 w-full transition-colors duration-300', expanded ? 'border-0 bg-[#232323]' : 'border-b border-gray-200 bg-white']">
      <!-- Убираем внешний .app-container: сам Nav содержит внутренний контейнер .nav-inner -->
      <Nav @expanded-change="expanded = $event" />
    </header>

    <!-- Мобильная контактная панель - прижата к навбару -->
    <MobileContactBar phone="+7 (918) 254 71 47" tel="+79182547147" telegramUrl="https://t.me/your_telegram"
      telegramMaxUrl="https://t.me/your_max" whatsAppUrl="https://wa.me/79182547147" />

    <!-- Убрали спейсер: панель услуг теперь накрывает контент на десктопе, не смещая его -->

    <main class="flex-1 lg:pt-0">
      <!-- Оставляем только вертикальные отступы контента, без вложенного .app-container,
           чтобы секции сами управляли шириной через собственные .app-container -->
      <transition name="page" mode="out-in" @before-enter="beforeEnter" @enter="enter" @leave="leave">
        <div :key="$page.url" class="content-wrapper">
          <slot />
        </div>
      </transition>
    </main>

    <!-- Back to top button -->
    <BackToTop />

    <footer>
      <Footer />
    </footer>
  </div>

</template>

<script setup>
import { ref, onMounted } from 'vue';
import { router } from '@inertiajs/vue3';
import Nav from '../Shared/Nav.vue';
import MobileContactBar from '../Shared/MobileContactBar.vue';
import Footer from '../Shared/Footer.vue';
import BackToTop from '../Components/BackToTop.vue';

const expanded = ref(false);

// Обработчики transition для плавной анимации
const beforeEnter = (el) => {
  el.style.opacity = 0;
  el.style.transform = 'translateY(20px)';
};

const enter = (el, done) => {
  el.offsetHeight; // trigger reflow
  el.style.transition = 'opacity 0.4s ease, transform 0.4s ease';
  el.style.opacity = 1;
  el.style.transform = 'translateY(0)';
  setTimeout(done, 400);
};

const leave = (el, done) => {
  el.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
  el.style.opacity = 0;
  el.style.transform = 'translateY(-10px)';
  setTimeout(done, 300);
};

// Автоматическая прокрутка вверх при переходе между страницами
onMounted(() => {
  router.on('navigate', () => {
    window.scrollTo({ top: 0, behavior: 'smooth' });
  });
});
</script>

<style scoped>
.layout-root {
  overflow-x: hidden;
  width: 100%;
}

.content-wrapper {
  overflow-x: hidden;
  width: 100%;
}
</style>
