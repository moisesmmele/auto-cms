import {createRouter, createWebHistory} from "vue-router";
import HomePage from "../pages/HomePage.vue";
import InventoryPage from "../pages/InventoryPage.vue";
import VehiclePage from "../pages/VehiclePage.vue";
import AdminLogin from "../admin/AdminLogin.vue";

const routes = [

    { path: "/", name: "Home", component: HomePage },
    { path: "/estoque", name: "InventoryPage", component: InventoryPage },
    { path: "/sobre", name: "AboutPage", component: HomePage },
    { path: "/contato", name: "ContactPage", component: HomePage },
    { path: "/estoque/{id}", name: "VehiclePage", component: VehiclePage },
    { path: "/admin/login", name: "AdminLogin", component: AdminLogin },


]

const router = createRouter({
    history: createWebHistory(),
    routes: routes
})

export default router