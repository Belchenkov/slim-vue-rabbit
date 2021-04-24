import Vue from 'vue'
import axios from 'axios'
import BootstrapVue from 'bootstrap-vue'

import App from './App.vue'
import router from './router'
import store from './store'

Vue.config.productionTip = false

Vue.use(BootstrapVue);

axios.defaults.baseURL = process.env.VUE_APP_API_URL;

new Vue({
  router,
  store,
  render: h => h(App)
}).$mount('#app')
