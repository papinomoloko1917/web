<template>
  <ProjectsGrid :cards="cards" :show-title="true" title="НАШИ ПРОЕКТЫ" :show-more-button="true" />
</template>

<script setup>
import ProjectsGrid from '../../Components/ProjectsGrid.vue'
import { projectsData } from '../../data/projectsData.js'

// Показываем все 6 проектов на главной странице
const cards = projectsData
</script>
