
import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter);

import Home from "./views/Home";
import SingleDoctor from "./pages/SingleDoctor";
import Search from "./pages/Search"


const router = new VueRouter(
    {
        mode:'history',

        routes: [
            {
                path: '/',
                name: 'home',
                component: Home
            },
            {
                path: '/doctors/:slug',
                name: 'single-doctor',
                component: SingleDoctor
            },
            {
                path: '/search',
                name: 'search',
                component: Search
            },

        ]
    }
);

export default router
