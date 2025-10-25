<template>
  <ProjectsGrid 
    :cards="cards" 
    :show-title="false"
    :show-more-button="false"
  />
</template>

<script setup>
import ProjectsGrid from '../../Components/ProjectsGrid.vue'
import { projectsData } from '../../data/projectsData.js'

// Показываем все проекты на странице "Проекты"
const cards = projectsData
</script>
