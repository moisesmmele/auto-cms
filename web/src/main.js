import { createApp } from 'vue'
import {createPinia} from "pinia";

import App from './App.vue'
import './style.css'
import router from "./router/index.js";

createApp(App)
    .mixin({
        computed: {
            isAdminPage() {
                return this.$route.path.startsWith('/admin/');
            },
        }
    })
    .use(createPinia())
    .use(router)
    .mount('#app');
