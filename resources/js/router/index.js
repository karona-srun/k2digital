import Vue from 'vue';
import VueRouter from 'vue-router';
import store from '../store';
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
            component: Home,
            meta: { guest: true },
        },
        {
            path: '/about',
            name: 'អំពី',
            component: About,
            meta: { guest: true },
        },
        {
            path: '/chong-banghoh',
            name: 'ចង់បង្ហោះ',
            component: ChongBanghoh,
            meta: { requiresAuth: true },
        },
        {
            path: '/sign-in',
            name: 'ចូលគណនី',
            component: SignIn,
            meta: { guest: true },
        },
        {
            path: '/sign-up',
            name: 'ចុះឈ្មោះ',
            component: SignUp,
            meta: { guest: true },
        }
    ]
});

router.afterEach((to, from) => {
    Vue.nextTick(() => {
        document.title = to.name + ' | K2 ​ឌីជីថល' || 'K2 ​ឌីជីថល';
    });
});

router.beforeEach((to, from, next) => {
    if (to.matched.some((record) => record.meta.requiresAuth)) {
        if (store.getters.isAuthenticated) {
            next();
            return;
        }
        next("/sign-in");
    } else {
        next();
    }
});

export default router;