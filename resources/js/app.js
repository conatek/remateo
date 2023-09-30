import './bootstrap';

import {createApp} from 'vue';
import components from '@/components';
import { Bootstrap4Pagination } from 'laravel-vue-pagination';
import { Bootstrap5Pagination } from 'laravel-vue-pagination';
import { TailwindPagination } from 'laravel-vue-pagination';

const app = createApp({});

Object.keys(components).forEach(key => {
    app.component(key, components[key]);
});

app.mount('#app');
