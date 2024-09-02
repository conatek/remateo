import { defineAsyncComponent } from 'vue';

const components = {
    'hello-component': defineAsyncComponent(() => import('./components/Hello.vue')),
    'world-component': defineAsyncComponent(() => import('./components/World.vue')),

    'campus-create': defineAsyncComponent(() => import('./components/campus/CampusCreate.vue')),
    'campus-edit': defineAsyncComponent(() => import('./components/campus/CampusEdit.vue')),

    'company-index': defineAsyncComponent(() => import('./components/company/CompanyIndex.vue')),
    'company-create': defineAsyncComponent(() => import('./components/company/CompanyCreate.vue')),
    'company-show': defineAsyncComponent(() => import('./components/company/CompanyShow.vue')),
    'company-detail': defineAsyncComponent(() => import('./components/company/CompanyDetail.vue')),
    'company-edit': defineAsyncComponent(() => import('./components/company/CompanyEdit.vue')),

    'control-panel': defineAsyncComponent(() => import('./components/company/ControlPanel.vue')),
    'sociodemographic-profile': defineAsyncComponent(() => import('./components/company/SociodemographicProfile.vue')),
    'alerts': defineAsyncComponent(() => import('./components/company/Alerts.vue')),
    'indicators': defineAsyncComponent(() => import('./components/company/Indicators.vue')),

    'collaborator-index': defineAsyncComponent(() => import('./components/collaborators/CollaboratorIndex.vue')),
    'collaborator-create': defineAsyncComponent(() => import('./components/collaborators/CollaboratorCreate.vue')),
    'collaborator-show': defineAsyncComponent(() => import('./components/collaborators/CollaboratorShow.vue')),
    'collaborator-edit': defineAsyncComponent(() => import('./components/collaborators/CollaboratorEdit.vue')),

};

// Vue.component('font-awesome-icon', FontAwesomeIcon);

export default components;
