<template>
    <div class="absolute inset-y-0 left-1/2 hidden lg:flex items-center transform -translate-x-1/2">
        <ul class="flex gap-9 items-center hover-scope" ref="topScope"
            :class="{ 'text-white': expanded, 'text-gray-800': !expanded }">
            <!-- Главная -->
            <li v-if="topNav[0]">
                <Link :href="topNav[0].href" class="text-current menu-link"
                    @mouseenter="$emit('top-item-enter', $event); $emit('link-enter', $event)"
                    @mouseleave="$emit('top-item-leave', $event); $emit('link-leave', $event)">{{ topNav[0].label }}
                </Link>
            </li>
            <!-- Услуги -->
            <li>
                <ServicesDropdown :expanded="expanded" @open="$emit('open-panel')" @close="$emit('close-panel')" />
            </li>
            <!-- Остальные пункты -->
            <li v-for="l in topNav.slice(1)" :key="l.label">
                <Link :href="l.href" class="text-current menu-link"
                    @mouseenter="$emit('top-item-enter', $event); $emit('link-enter', $event)"
                    @mouseleave="$emit('top-item-leave', $event); $emit('link-leave', $event)">{{ l.label }}</Link>
            </li>
        </ul>
    </div>
</template>

<script>
import { Link } from '@inertiajs/vue3';
import ServicesDropdown from '../Components/Header/ServicesDropdown.vue';
import { topLinks } from '../data/nav.js';

export default {
    name: 'DesktopNav',
    components: { Link, ServicesDropdown },
    props: {
        expanded: { type: Boolean, default: false }
    },
    methods: {
        getTopScope() {
            return this.$refs.topScope;
        }
    },
    data() {
        return {
            topNav: topLinks
        }
    }
};
</script>

<style scoped></style>
