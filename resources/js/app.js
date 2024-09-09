import './bootstrap';
import '../saas/app.scss'
import { createApp,ref } from 'vue';
import Contents from './components/Contents.vue';
import router from './routes';
const app = createApp()
app.component('contents',Contents)
app.use(router)
app.mount("#app")