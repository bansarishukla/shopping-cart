

require('./bootstrap');

window.Vue = require('vue');



Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('task-list', require("./components/TaskList.vue").default);

import Vue from 'vue';

new Vue({
    el: '#app',
});
