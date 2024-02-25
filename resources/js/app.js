import './bootstrap';

import {createApp} from 'vue';
import components from '@/components';

import { library } from '@fortawesome/fontawesome-svg-core';
import { fas } from '@fortawesome/free-solid-svg-icons';
import { far } from '@fortawesome/free-regular-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';


const app = createApp({});


Object.keys(components).forEach(key => {
    app.component(key, components[key]);
});

library.add(fas);
library.add(far);
app.component('font-awesome-icon', FontAwesomeIcon);

app.mount('#app');
