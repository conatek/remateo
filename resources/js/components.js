import { defineAsyncComponent } from 'vue';


const components = {
    'hello-component': defineAsyncComponent(() => import('./components/Hello.vue')),
    'world-component': defineAsyncComponent(() => import('./components/World.vue')),

    'campus-create': defineAsyncComponent(() => import('./components/campus/CampusCreate.vue')),
    'campus-edit': defineAsyncComponent(() => import('./components/campus/CampusEdit.vue')),

};

export default components;
