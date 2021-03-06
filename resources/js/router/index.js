import Vue from 'vue';
import VueRouter from 'vue-router';
import store from '../store';
import Home from '../pages/Home.vue';
import About from '../pages/About.vue';
import ChongBanghoh from '../pages/chong_banghoh/Index.vue';
import PETools from '../pages/petools/Index.vue';
import Account from '../pages/petools/Account.vue';
import AccountPE from '../pages/petools/AccountPE.vue';
// Page section
import PageText from '../pages/petools/pages/Text.vue';
import PageVideo from '../pages/petools/pages/Video.vue';
import PageImage from '../pages/petools/pages/Image.vue';
// Profile section
import ProfileText from '../pages/petools/profiles/Text.vue';
import ProfileImage from '../pages/petools/profiles/Image.vue';
import ProfileVideo from '../pages/petools/profiles/Video.vue';
// Group section
import GroupText from '../pages/petools/groups/Text.vue';
import GroupImage from '../pages/petools/groups/Image.vue';
import GroupVideo from '../pages/petools/groups/Video.vue';

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
            name: '????????????????????????',
            component: Home,
            meta: { guest: true },
        },
        {
            path: '/about',
            name: '????????????',
            component: About,
            meta: { guest: true },
        },
        {
            path: '/chong-banghoh',
            name: '???????????????????????????',
            component: ChongBanghoh,
            meta: { requiresAuth: true },
        },
        {
            path: '/pe-tools',
            name: 'PETools',
            component: PETools,
        },
        {
            path: '/pe-tools/profile/post-text',
            name: "Profile Text - ????????????????????????????????????",
            component: ProfileText
        },
        {
            path: '/pe-tools/profile/post-image',
            name: "Profile Image - ????????????????????????????????????",
            component: ProfileImage
        },
        {
            path: '/pe-tools/profile/post-video',
            name: "Profile Video - ????????????????????????????????????",
            component: ProfileVideo
        },
        {
            path: '/pe-tools/page/post-text',
            name: "??????????????? Page - ????????????????????????????????????",
            component: PageText
        },
        {
            path: '/pe-tools/page/post-image',
            name: "??????????????? Page - ????????????????????????????????????",
            component: PageImage
        },
        {
            path: '/pe-tools/page/post-video',
            name: "??????????????? Page - ????????????????????????????????????",
            component: PageVideo
        },
        {
            path: '/pe-tools/group/post-text',
            name: "??????????????? Group - ????????????????????????????????????",
            component: GroupText
        },
        {
            path: '/pe-tools/group/post-image',
            name: "??????????????? Group - ????????????????????????????????????",
            component: GroupImage
        },
        {
            path: '/pe-tools/group/post-video',
            name: "??????????????? Group - ????????????????????????????????????",
            component: GroupVideo
        },
        {
            path: '/pe-tools/account',
            name: '??????????????? PETools',
            component: AccountPE,
        },
        {
            path: '/account',
            name: '????????????',
            component: Account,
        },
        {
            path: '/tiktok-tools',
            name: 'TikTok',
            component: TikTok,
        },
        {
            path: '/sign-in',
            name: '?????????????????????',
            component: SignIn,
            meta: { guest: true },
        },
        {
            path: '/sign-up',
            name: '????????????????????????',
            component: SignUp,
            meta: { guest: true },
        }
    ]
});

router.afterEach((to, from) => {
    Vue.nextTick(() => {
        document.title = to.name + ' | K2 ?????????????????????' || 'K2 ?????????????????????';
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