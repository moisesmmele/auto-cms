<script>
import HeaderNavItem from "./HeaderNavItem.vue";
import PrimaryOutlineButton from "../PrimaryOutlineButton.vue";
import router from "../../router/index.js";
import {useUserStore} from "../../stores/useUserStore.js";
import security from "../../security.js";
import notie from "notie/dist/notie.js";

export default {
  name: "AppHeader",
  data(){
    return {
      showConfig: false
    }
  },
  components: { HeaderNavItem, PrimaryOutlineButton, },
  methods: {
    login() {
      router.push('/admin/login')
    },
    async logout() {
      console.log('logout')
      const userStore = useUserStore()
      let id = userStore.user?.id

      const success = await security.logout(id)
      if (!success) {
        notie.alert({type:'error', text:"Erro ao sair do sistema!"})
        console.error('something went wrong!')
      } else {
        notie.alert({type:'success', text:"Desconectado."})
        userStore.clearUser()
        router.push('/')
      }
    },
    toggleConfig() {
      this.showConfig = !this.showConfig;
    },
    handleClickOutside(event) {
      const dropdown = this.$refs.configDropdown;
      if (dropdown && !dropdown.contains(event.target)) {
        this.showConfig = false;
      }
    },
  },
  computed: {
    userStore: function () {
      return useUserStore()
    },
  },
  mounted() {
    document.addEventListener('click', this.handleClickOutside);
  },
  beforeUnmount() {
    document.removeEventListener('click', this.handleClickOutside);
  },
}

</script>

<template>
  <header v-if="this.userStore.isLoggedIn" class="bg-secondary shadow-md left-0 w-full">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between items-center h-20">
        <div class="flex-shrink-0 h-full">
          <router-link to="/">
            <img src="../../assets/logo.png" class="w-full h-full object-contain">
          </router-link>
        </div>
        <nav class="flex items-center space-x-8 relative">
          <RouterLink to="/admin/dashboard" class="text-gray-100 hover:font-medium transition delay-300">Dashboard</RouterLink>
          <RouterLink to="/admin/leads" class="text-gray-100 hover:font-medium transition delay-300">Leads</RouterLink>
          <RouterLink to="/admin/anuncios" class="text-gray-100 hover:font-medium transition delay-300">Anúncios</RouterLink>
          <RouterLink to="/admin/veiculos" class="text-gray-100 hover:font-medium transition delay-300">Veículos</RouterLink>

          <!-- Configurações Dropdown -->
          <div class="relative" ref="configDropdown">
            <button
                @click="toggleConfig"
                class="text-gray-100 flex gap-2 items-center hover:font-medium transition delay-300 focus:outline-none"
            >
              Configurações
              <svg
                  :class="{'rotate-180': showConfig}"
                  class="w-4 h-4 transition-transform duration-200"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="2"
                  viewBox="0 0 24 24"
                  xmlns="http://www.w3.org/2000/svg"
              >
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path>
              </svg>
            </button>
            <div v-if="showConfig" class="absolute top-full mt-2 bg-white text-gray-800 shadow-lg rounded-md py-2 w-48 z-50">
              <RouterLink to="/admin/config/marcas" class="block px-4 py-2 hover:bg-gray-100">Marcas</RouterLink>
              <RouterLink to="/admin/config/chassis" class="block px-4 py-2 hover:bg-gray-100">Chassis</RouterLink>
              <RouterLink to="/admin/config/combustiveis" class="block px-4 py-2 hover:bg-gray-100">Combustiveis</RouterLink>
              <RouterLink to="/admin/config/transmissoes" class="block px-4 py-2 hover:bg-gray-100">Transmissões</RouterLink>
              <RouterLink to="/admin/config/acessorios" class="block px-4 py-2 hover:bg-gray-100">Acessórios</RouterLink>
              <RouterLink to="/admin/config/cores" class="block px-4 py-2 hover:bg-gray-100">Cores</RouterLink>
              <hr class="border-gray-200 mt-2 mb-2">
              <RouterLink to="/admin/config/usuarios" class="block px-4 py-2 hover:bg-gray-100">Usuarios</RouterLink>
              <RouterLink to="/admin/config/empresa" class="block px-4 py-2 hover:bg-gray-100">Empresa</RouterLink>

            </div>
          </div>

          <PrimaryOutlineButton link="/admin/logout" value="Logout" @click="logout"/>
        </nav>
      </div>
    </div>
  </header>
  <header v-else class="bg-secondary shadow-md left-0 w-full">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between items-center h-20">
        <div class="flex-shrink-0 h-full">
          <router-link to="/">
            <img src="../../assets/logo.png" class="w-full h-full object-contain">
          </router-link>
        </div>
        <nav class="flex items-center space-x-8">
          <RouterLink to="/estoque" class="text-gray-100 hover:font-medium transition delay-300">Estoque</RouterLink>
          <RouterLink to="#" class="text-gray-100 hover:font-medium transition delay-300">Contato</RouterLink>
          <RouterLink to="#" class="text-gray-100 hover:font-medium transition delay-300">Sobre</RouterLink>

          <PrimaryOutlineButton value="Login" type="button" @click="login"/>
        </nav>
      </div>
    </div>
  </header>

</template>

<style scoped>

</style>