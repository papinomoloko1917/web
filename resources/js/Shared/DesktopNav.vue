<template>
    <div class="absolute inset-y-0 left-1/2 hidden lg:flex items-center transform -translate-x-1/2">
        <ul class="flex gap-9 items-center hover-scope" ref="topScope"
            :class="{ 'text-white': expanded, 'text-gray-800': !expanded }">
            <li>
                <ServicesDropdown :expanded="expanded" @open="$emit('open-panel')" @close="$emit('close-panel')" />
            </li>
            <li v-for="l in topNav" :key="l.label">
                <a :href="l.href" class="text-current menu-link"
                    @mouseenter="$emit('top-item-enter', $event); $emit('link-enter', $event)"
                    @mouseleave="$emit('top-item-leave', $event); $emit('link-leave', $event)">{{ l.label }}</a>
            </li>
        </ul>
    </div>
</template>

<script>
import ServicesDropdown from '../Components/Header/ServicesDropdown.vue';
import { topLinks } from '../data/nav.js';

export default {
    name: 'DesktopNav',
    components: { ServicesDropdown },
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
