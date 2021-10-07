import { createApp } from 'vue'
import App from "./App.vue";
import router from './router'
import store from './store';

const app = createApp(App)
    .use(store)
    .use(router);
router.app = app;
// axios.app = app;
store.$app = app;

app.mount('#app');
