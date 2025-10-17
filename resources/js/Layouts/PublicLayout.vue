<template>
  <div class="layout-root">
    <div class="app-container">
      <Nav />
    </div>

    <main class="flex-1">
      <div class="app-container content-wrapper">
        <slot />
      </div>
    </main>

    <footer>
      <div class="app-container">
        <!-- Footer content -->
      </div>
    </footer>
  </div>

</template>

<script setup>
import Nav from '../Shared/Nav.vue';
</script>

<style>
.app-container {
  width: 100%;
  max-width: 1440px; /* нужная ширина */
  margin: 0 auto;
  padding: 0 24px;
  box-sizing: border-box;
}

.layout-root {
  min-height: 100vh;
  display: flex;
  flex-direction: column;
}

main { flex: 1; }

.content-wrapper {
  padding: 32px 0;
}
</style>