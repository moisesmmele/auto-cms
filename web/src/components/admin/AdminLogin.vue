<script>
import security from "../security.js";
import router from "../../router/index.js";
import notie from "notie/dist/notie.js";
import {useUserStore} from "../../stores/useUserStore.js";

export default {
  name: 'AdminLogin',
  data() {
    return {
      email: '',
      password: ''
    }
  },
  computed: {
    userStore: function () {
      return useUserStore()
    },
  },
  methods: {
    async handleLogin() {
      console.log("attempting login")
      const success = await security.login(this.email, this.password);
      if (success) {
        notie.alert({type: "success", text: "Login realizado com sucesso!"})
        this.userStore.setUser(security.loadUser())
        router.push("/admin/dashboard")
      } else {
        notie.alert({type: "error", text: "Usuário ou senha incorretos."})
      }
    },
    async handleLogout() {

    }
  }
}
</script>
<template>
  <div class="flex flex-col">
    <!-- Main Content -->
    <main class="flex-grow flex items-center justify-center">
      <div class="bg-secondary text-white rounded-lg shadow-lg w-full max-w-md overflow-hidden">
        <div class="p-8 text-center">
          <p class="text-3xl mb-8">Painel de Gerenciamento</p>
          <form @submit.prevent="handleLogin">
            <div class="mb-4">
              <input type="text" v-model="email" placeholder="Usuário" class="w-full p-2 text-center text-gray-900 bg-gray-50 rounded">
            </div>
            <div class="mb-6">
              <input type="password" v-model="password" placeholder="Senha" class="w-full p-2 text-center text-gray-900 bg-gray-50 rounded">
            </div>
            <button type="submit" class="w-full bg-primary text-secondary font-bold py-3 rounded hover:bg-[#b8e800] transition-colors">
              Entrar
            </button>
          </form>
        </div>
      </div>
    </main>
  </div>
</template>
<style scoped>
</style>