/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

// require('./bootstrap');

window.Vue = require('vue').default;
import { DropDownListComponent, DropDownListPlugin } from '@syncfusion/ej2-vue-dropdowns';

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
window.translate=require('./VueTranslation/Translation').default.translate;
Vue.prototype.translate=require('./VueTranslation/Translation').default.translate;

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('add-medical-test', require('./components/addMedicalTest.vue').default);
Vue.component('add-medicine', require('./components/addMedicine.vue').default);
Vue.component('resrvation-page', require('./components/resrvationPage.vue').default);
Vue.component('choose-vac', require('./components/chooseVacc.vue').default);
Vue.component('reservation-details-card', require('./components/reservationDetailsCard.vue').default);
Vue.component(DropDownListPlugin.name, DropDownListComponent);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
