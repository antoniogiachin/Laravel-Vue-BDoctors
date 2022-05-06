
import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter);

import SingleDoctor from "./pages/SingleDoctor";


const router = new VueRouter(
    {
        mode:'history',

        routes: [
            {
                path: '/doctors/:slug',
                name: 'single-doctor',
                component: SingleDoctor
            }
        ]
    }
);

export default router
