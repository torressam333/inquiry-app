import Vue from 'vue';
import VueRouter from 'vue-router';
import routes from './routes';

Vue.use(VueRouter);

//Instantiate Vue Routed
const router = new VueRouter({
    mode: 'history',
    routes,
    linkActiveClass: 'active'
});

//Global before guard
router.beforeEach((to, from, next)=>{
    //If someone is not signed in and tries
    // to access a route that requires authorization
    if (to.matched.some(r => r.meta.requiresAuth) && !window.Auth.signedIn) {
        //Redirect unauthorized user
        window.location = window.Auth.url;
        //Ignore next execution outside of if()
        return;
    }
    //Move on to next hook
    next()
});

export default router;

