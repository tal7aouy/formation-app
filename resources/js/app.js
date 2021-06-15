require("./bootstrap");

// Import modules...
import { createApp, h } from "vue";
import {
    App as InertiaApp,
    plugin as InertiaPlugin,
} from "@inertiajs/inertia-vue3";
import mitt from "mitt";
const emitter = mitt();
import { InertiaProgress } from "@inertiajs/progress";

const el = document.getElementById("app");

const app = createApp({
    render: () =>
        h(InertiaApp, {
            initialPage: JSON.parse(el.dataset.page),
            resolveComponent: (name) => require(`./Pages/${name}`).default,
        }),
});
app.config.globalProperties.emitter = emitter;

app.mixin({ methods: { route } }).use(InertiaPlugin).mount(el);

InertiaProgress.init({ color: "#228B22	" });
