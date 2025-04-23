import {createRouter, createWebHistory} from "vue-router";
import HomePage from "../components/pages/HomePage.vue";
import InventoryPage from "../components/pages/InventoryPage.vue";
import VehiclePage from "../components/pages/VehiclePage.vue";
import AdminLogin from "../components/admin/AdminLogin.vue";
import adminDashboard from "../components/admin/AdminDashboard.vue";

const routes = [

    { path: "/", name: "Home", component: HomePage },
    { path: "/estoque", name: "InventoryPage", component: InventoryPage },
    { path: "/sobre", name: "AboutPage", component: HomePage },
    { path: "/contato", name: "ContactPage", component: HomePage },
    { path: "/estoque/:id", name: "VehiclePage", component: VehiclePage },
    { path: "/admin/login", name: "AdminLogin", component: AdminLogin },
    { path: "/admin/dashboard", name: "AdminDashboard", component: adminDashboard },



]

const router = createRouter({
    history: createWebHistory(),
    routes: routes
})

export default router