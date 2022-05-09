
import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter);

import Home from "./views/Home";
import MainHomepage from "./pages/MainHomepage";
import SingleDoctor from "./pages/SingleDoctor";


const router = new VueRouter(
    {
        mode:'history',

        routes: [

            {
                path: '/',
                name: 'home',
                component: MainHomepage,
            },
            {
                path: '/doctors/:slug',
                name: 'single-doctor',
                component: SingleDoctor,
            }
        ]
    }
);

export default router
