import { createRouter, createWebHistory } from "vue-router";
import HomePage from "../components/pages/Home/HomePage.vue";
import InventoryPage from "../components/pages/Inventory/InventoryPage.vue";
import VehiclePage from "../components/pages/Vehicle/VehiclePage.vue";
import AdminLogin from "../components/pages/admin/AdminLogin.vue";
import adminDashboard from "../components/pages/admin/dashboard/AdminDashboard.vue";
import AdminListings from "../components/pages/admin/Listings/AdminListings.vue";
import adminVehicles from "../components/pages/admin/vehicles/AdminVehicles.vue";
import AdminConfig from "../components/pages/admin/AdminConfig.vue";
import UsersPage from "../components/pages/admin/Configs/users/UsersPage.vue";
import ColorsPage from "../components/pages/admin/Configs/ColorsPage.vue";
import GearboxesPage from "../components/pages/admin/Configs/GearboxesPage.vue";
import AccessoriesPage from "../components/pages/admin/Configs/AccessoriesPage.vue";
import chassisPage from "../components/pages/admin/Configs/ChassisPage.vue";
import MakesPage from "../components/pages/admin/Configs/MakesPage.vue";
import FuelsPage from "../components/pages/admin/Configs/FuelsPage.vue";
import adminLeads from "../components/pages/admin/leads/AdminLeads.vue";

const routes = [
    { path: "/", name: "Home", component: HomePage },
    { path: "/estoque", name: "InventoryPage", component: InventoryPage },
    { path: "/sobre", name: "AboutPage", component: HomePage },
    { path: "/contato", name: "ContactPage", component: HomePage },
    { path: "/estoque/:id", name: "VehiclePage", component: VehiclePage },
    { path: "/admin/login", name: "AdminLogin", component: AdminLogin },

    // Protected admin routes
    { path: "/admin/dashboard", name: "AdminDashboard", component: adminDashboard, meta: { requiresAuth: true } },
    { path: "/admin/anuncios", name: "AdminListings", component: AdminListings, meta: { requiresAuth: true } },
    { path: "/admin/veiculos", name: "AdminVehicles", component: adminVehicles, meta: { requiresAuth: true } },
    { path: "/admin/leads", name: "AdminLeads", component: adminLeads, meta: { requiresAuth: true } },
    { path: "/admin/config/usuarios", name: "UsersPage", component: UsersPage, meta: { requiresAuth: true } },
    { path: "/admin/config/transmissoes", name: "GearboxesPage", component: GearboxesPage, meta: { requiresAuth: true } },
    { path: "/admin/config/cores", name: "ColorsPage", component: ColorsPage, meta: { requiresAuth: true } },
    { path: "/admin/config/chassis", name: "ChassisPage", component: chassisPage, meta: { requiresAuth: true } },
    { path: "/admin/config/marcas", name: "MakesPage", component: MakesPage, meta: { requiresAuth: true } },
    { path: "/admin/config/combustiveis", name: "FuelsPage", component: FuelsPage, meta: { requiresAuth: true } },
    { path: "/admin/config/acessorios", name: "AcessoriesPage", component: AccessoriesPage, meta: { requiresAuth: true } },
    { path: "/admin/config/empresa", name: "EmpresaPage", component: AdminConfig, meta: {requiresAuth: true } }
]

const router = createRouter({
    history: createWebHistory(),
    scrollBehavior(to, from, savedPosition) {
        return { top: 0 }
    },
    routes: routes
})

//Navigation guard to protect admin routes
router.beforeEach((to, from, next) => {
    const user = JSON.parse(localStorage.getItem('user'))
    if (to.meta.requiresAuth && !user) {
        next({ path: '/admin/login' })
    } else {
        next()
    }
})

export default router
