<script>
import Modal from "../Modal.vue";
import {useUserStore} from "../../stores/useUserStore.js";

export default {
  name: "AdminDashboard",
  components: {Modal},
  computed: {
    userStore: function() {
      return useUserStore()
    }
  }
}
</script>
<template>
  <div class="flex mx-auto">
    <main class="bg-white p-8 flex flex-col justify-center">
      <!-- Welcome message -->
      <div class="mb-12">
        <h1 class="text-secondary text-2xl font-medium">
          Bem vindo, <span class="font-bold">{{userStore.user.firstName}}!</span>
        </h1>
      </div>

      <!-- Dashboard cards -->
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6 w-7xl">
        <!-- Leads Card -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
          <div class="bg-secondary text-white p-4 flex justify-between items-center">
            <h2 class="text-xl font-medium">Leads</h2>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-up-right"><path d="M7 7h10v10"/><path d="M7 17 17 7"/></svg>
          </div>
          <div class="divide-y divide-gray-200">
            <div class="flex justify-between items-center p-4">
              <span>Novos leads</span>
              <div class="bg-gray-300 text-white rounded-full w-8 h-8 flex items-center justify-center text-xs">00</div>
            </div>
            <div class="flex justify-between items-center p-4">
              <span>Leads em aberto</span>
              <div class="bg-gray-300 text-white rounded-full w-8 h-8 flex items-center justify-center text-xs">00</div>
            </div>
            <div class="flex justify-between items-center p-4">
              <span>Leads encerrados</span>
              <div class="bg-gray-300 text-white rounded-full w-8 h-8 flex items-center justify-center text-xs">00</div>
            </div>
            <div class="flex justify-between items-center p-4">
              <span>Total de leads</span>
              <div class="bg-gray-300 text-white rounded-full w-8 h-8 flex items-center justify-center text-xs">00</div>
            </div>
          </div>
        </div>

        <!-- Anúncios Card -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
          <div class="bg-secondary text-white p-4 flex justify-between items-center">
            <h2 class="text-xl font-medium">Anúncios</h2>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-up-right"><path d="M7 7h10v10"/><path d="M7 17 17 7"/></svg>
          </div>
          <div class="divide-y divide-gray-200">
            <div class="flex justify-between items-center p-4">
              <span>Anúncios ativos</span>
              <div class="bg-gray-300 text-white rounded-full w-8 h-8 flex items-center justify-center text-xs">00</div>
            </div>
            <div class="flex justify-between items-center p-4">
              <span>Promoções ativas</span>
              <div class="bg-gray-300 text-white rounded-full w-8 h-8 flex items-center justify-center text-xs">00</div>
            </div>
            <div class="flex justify-between items-center p-4">
              <span>Anúncios desativados</span>
              <div class="bg-gray-300 text-white rounded-full w-8 h-8 flex items-center justify-center text-xs">00</div>
            </div>
            <div class="flex justify-between items-center p-4">
              <span>Total de anúncios</span>
              <div class="bg-gray-300 text-white rounded-full w-8 h-8 flex items-center justify-center text-xs">00</div>
            </div>
          </div>
        </div>

        <!-- Carros Card -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
          <div class="bg-secondary text-white p-4 flex justify-between items-center">
            <h2 class="text-xl font-medium">Carros</h2>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-up-right"><path d="M7 7h10v10"/><path d="M7 17 17 7"/></svg>
          </div>
          <div class="divide-y divide-gray-200">
            <div class="flex justify-between items-center p-4">
              <span>Carros cadastrados</span>
              <div class="bg-gray-300 text-white rounded-full w-8 h-8 flex items-center justify-center text-xs">00</div>
            </div>
            <div class="flex justify-between items-center p-4">
              <span>Carros anunciados</span>
              <div class="bg-gray-300 text-white rounded-full w-8 h-8 flex items-center justify-center text-xs">00</div>
            </div>
            <div class="flex justify-between items-center p-4">
              <span>Carros sem anúncio</span>
              <div class="bg-gray-300 text-white rounded-full w-8 h-8 flex items-center justify-center text-xs">00</div>
            </div>
            <div class="flex justify-between items-center p-4">
              <span>Total de carros</span>
              <div class="bg-gray-300 text-white rounded-full w-8 h-8 flex items-center justify-center text-xs">00</div>
            </div>
          </div>
        </div>
      </div>
    </main>
  </div>
</template>
<style scoped>

</style>