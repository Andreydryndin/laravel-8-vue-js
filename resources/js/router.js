import vueRouter from 'vue-router';
import Vue from 'vue';

Vue.use(vueRouter);

import Notebook from "./views/Notebook";
import View from "./views/View";
import CreateNotebook from "./views/CreateNotebook";
import EditNotebook from "./views/EditNotebook";

const routes = [
    {
        path: "/",
        component: Notebook
    },
    {
        path: "/notebook/:id",
        component: View
    },
    {
        path: "/notebook/edit/:id",
        component: EditNotebook
    },
    {
        path: "/create",
        component: CreateNotebook
    },
];

export default new vueRouter({
    mode: "history",
    routes
});
