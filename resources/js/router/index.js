import Vue from 'vue';
import VueRouter from 'vue-router';
import store from '../store';
import Home from '../pages/Home.vue';
import About from '../pages/About.vue';
import ChongBanghoh from '../pages/chong_banghoh/Index.vue';
import PETools from '../pages/petools/Index.vue';
import Account from '../pages/petools/Account.vue';
import AccountPE from '../pages/petools/AccountPE.vue';
import Page from '../pages/petools/Page.vue';
import Profile from '../pages/petools/Profile.vue';
import Group from '../pages/petools/Group.vue';

import TikTok from '../pages/tiktok/Index.vue';
import SignIn from '../pages/auth/SignIn.vue';
import SignUp from '../pages/auth/SignUp.vue';
Vue.use(VueRouter);

const originalPush = VueRouter.prototype.push;
VueRouter.prototype.push = function push(location) {
    return originalPush.call(this, location).catch((error) => {
        console.log(error.message);
    });
};

// scrollBehavior:
// - only available in html5 history mode
// - defaults to no scroll behavior
// - return false to prevent scroll
const scrollBehavior = (to, from, savedPosition) => {
    if (savedPosition) {
      // savedPosition is only available for popstate navigations.
      console.log("savedPosition")
      return savedPosition
    } else {
      const position = {}
      // new navigation.
      // scroll to anchor by returning the selector
      if (to.hash) {
        position.selector = to.hash
        console.log(to)
  
        // specify offset of the element
        if (to.hash === '#anchor2') {
          position.offset = { y: 100 }
        }
      }
      // check if any matched route config has meta that requires scrolling to top
      if (to.matched.some(m => m.meta.scrollToTop)) {
        // cords will be used if no selector is provided,
        // or if the selector didn't match any element.
        position.x = 0
        position.y = 0
      }
      // if the returned position is falsy or an empty object,
      // will retain current scroll position.
      return position
    }
}


const router = new VueRouter({
    mode: 'hash',
    scrollBehavior,
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
            path: '/pe-tools',
            name: 'PETools',
            component: PETools,
        },
        {
            path: '/pe-tools/profile',
            name: "គណនី Profiles",
            component: Profile
        },
        {
            path: '/pe-tools/page',
            name: "ទំព័រ Page",
            component: Page
        },
        {
            path: '/pe-tools/group',
            name: "ក្រុម Group",
            component: Group
        },
        {
            path: '/pe-tools/account',
            name: 'គណនី​ PETools',
            component: AccountPE,
        },
        {
            path: '/account',
            name: 'គណនី',
            component: Account,
        },
        {
            path: '/tiktok-tools',
            name: 'TikTok',
            component: TikTok,
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
        next({ path: "/sign-in" });
    } else {
        next();
    }
});

export default router;