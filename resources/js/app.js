require('./bootstrap');

import { createApp } from 'vue';
import Schedule from './views/Schedule.vue';

const app = createApp({});

app.component('Schedule', Schedule);

app.mount('#app');
