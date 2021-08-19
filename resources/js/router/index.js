import Vue from 'vue';
import VueRouter from 'vue-router';

import Home from '../pages/Home.vue';
import About from '../pages/About.vue';
import ChongBanghoh from '../pages/chong_banghoh/Index.vue';
import SignIn from '../pages/auth/SignIn.vue';
import SignUp from '../pages/auth/SignUp.vue';
Vue.use(VueRouter);

const originalPush = VueRouter.prototype.push;
VueRouter.prototype.push = function push(location) {
  return originalPush.call(this, location).catch((error) => {
  });
};

const router = new VueRouter({
    mode: 'history',
    linkExactActiveClass: 'active',
    routes: [
        {
            path: '/',
            name: 'ទំព័រដើម',
            component: Home
        },
        {
            path: '/about',
            name: 'អំពី',
            component: About
        },
        {
            path: '/chong-banghoh',
            name: 'ចង់បង្ហោះ',
            component: ChongBanghoh
        },
        {
            path: '/sign-in',
            name: 'ចូលគណនី',
            component: SignIn
        },
        {
            path: '/sign-up',
            name: 'ចុះឈ្មោះ',
            component: SignUp
        }
    ]
});

router.afterEach((to, from) => {
    Vue.nextTick(() => {
        document.title = to.name + ' | K2 ​ឌីជីថល' || 'K2 ​ឌីជីថល';
    });
});

export default router;