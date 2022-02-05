/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
const { default: Axios } = require('./external/Axios.js');
const { default: HabboAcademy } = require('./habboacademy/default');

window.Vue = require('vue').default
window.academyEventBus = new Vue({})

Vue.prototype.$http = Axios;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

const files = require.context('./', true, /\.vue$/i)
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

document.addEventListener('turbolinks:load', () => {
    let hasFurniValuesApp = !! document.getElementById('furniValuesApp')

    HabboAcademy.init()

    // FurniValues VueJS Component
    if(hasFurniValuesApp) {
        const furniValuesApp = new Vue({ el: '#furniValuesApp',
            beforeMount() {
                if (this.$el.parentNode) {
                    document.addEventListener('turbolinks:visit', () => this.$destroy(), { once: true })
                    this.$originalEl = this.$el.outerHTML
                }
            },
    
            destroyed() { this.$el.outerHTML = this.$originalEl }
        });
    }
})