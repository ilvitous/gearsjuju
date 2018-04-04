import Vue from 'vue';
import VueRouter from 'vue-router';
import axios from 'axios';
import VueAxios from 'vue-axios';
import App from './App.vue';
import Dashboard from './components/Dashboard.vue';
import Home from './components/Home.vue';
import Register from './components/Register.vue';
import Login from './components/Login.vue';
import Users from './components/Users.vue';
import UserCat from './components/UserCat.vue';
import Events from './components/Events.vue';

Vue.use(VueRouter);
Vue.use(VueAxios, axios);
axios.defaults.baseURL = window.location.origin + '/api';
const router = new VueRouter({
    routes: [{
        path: '/',
        name: 'home',
        component: Home
       
    },{
        path: '/dashboard',
        name: 'dashboard',
        component: Dashboard,
         meta: {
            auth: true,
            
        }
    },{
        path: '/users',
        name: 'users',
        component: Users,
         meta: {
            auth: true,
            
        },
    },{
        path: '/user-categories',
        name: 'user-categories',
        component: UserCat,
         meta: {
            auth: true,
        }
    },{
        path: '/events',
        name: 'events',
        component: Events,
         meta: {
            auth: true,
        }
    }
    ]
    
    
});




var authOptions = {
    auth: require('@websanova/vue-auth/drivers/auth/bearer.js'),
    http: require('@websanova/vue-auth/drivers/http/axios.1.x.js'),
    router: require('@websanova/vue-auth/drivers/router/vue-router.2.x.js'),
    authRedirect:'/',
};


Vue.router = router
Vue.use(require('@websanova/vue-auth'),authOptions)






App.router = Vue.router
new Vue(App).$mount('#app');