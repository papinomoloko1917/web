import "./bootstrap";

import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/vue3";
import { InertiaProgress } from "@inertiajs/progress";
import DefaultLayout from "./Layouts/PublicLayout.vue";

createInertiaApp({
    resolve: (name) => {
        const pages = import.meta.glob("./Pages/**/*.vue", { eager: true });
        const page = pages[`./Pages/${name}.vue`];

        // назначаем общий layout только если страница сама не задала layout
        if (page?.default) {
            page.default.layout = page.default.layout ?? DefaultLayout;
        }

        return page;
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .mount(el);
    },
});

InertiaProgress.init();
