<script>
import HeaderNavItem from "./HeaderNavItem.vue";
import PrimaryOutlineButton from "../PrimaryOutlineButton.vue";
import router from "../../router/index.js";
import {useUserStore} from "../../stores/useUserStore.js";
import security from "../../security.js";
import notie from "notie/dist/notie.js";

export default {
  name: "AppHeader",
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
    }
  },
  computed: {
    userStore: function () {
      return useUserStore()
    },
  }
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
        <nav class="flex items-center space-x-8">
          <HeaderNavItem link="/estoque" value="Dasboard"/>
          <HeaderNavItem link="/sobre" value="Leads"/>
          <HeaderNavItem link="/sobre" value="Anúncios"/>
          <HeaderNavItem link="/contato" value="Carros"/>
          <HeaderNavItem link="/sobre" value="Configurações"/>
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
          <HeaderNavItem link="/estoque" value="Estoque"/>
          <HeaderNavItem link="/sobre" value="Sobre"/>
          <HeaderNavItem link="/contato" value="Contato"/>
          <PrimaryOutlineButton value="Login" type="button" @click="login"/>
        </nav>
      </div>
    </div>
  </header>

</template>

<style scoped>

</style>