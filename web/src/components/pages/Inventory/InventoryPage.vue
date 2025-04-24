<script>

import InventoryVehicleCard from "./InventoryVehicleCard.vue";
export default {
  name: "InventoryPage",
  components: {InventoryVehicleCard},
  data() {
    return {
      listings: Object,
      baseUrl: "http://localhost:8083"
    }
  },
  beforeMount() {
    fetch('http://localhost:8083/listings')
        .then((response) => (response.json()))
        .then( (response) => {
          this.listings = response.listings
        })
  }
}
</script>
<template>
  <div class="min-h-screen flex flex-col bg-white">
    <!-- Search Bar -->
    <div class="container mx-auto px-4 py-4 flex gap-2">
      <div class="relative flex-grow">
        <input
            type="text"
            placeholder="Buscar por marca, modelo, ano, cor..."
            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-gray-400"
        />
      </div>
      <button class="px-6 py-2 bg-lime-400 text-black font-medium rounded-md hover:bg-lime-500">
        Buscar
      </button>
    </div>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-4 flex-grow">
      <!-- Header -->
      <div class="flex justify-between items-center mb-6">
        <div class="flex items-center gap-4">
          <h1 class="text-2xl font-bold text-gray-800">Estoque</h1>
          <span class="text-gray-500">25 Resultados</span>
        </div>
        <div class="flex items-center gap-2">
          <span class="text-sm text-gray-600">Ordenar por:</span>
          <div class="relative">
            <select class="appearance-none bg-white border border-gray-300 rounded-md px-3 py-1 pr-8 focus:outline-none">
              <option>Relevância</option>
              <option>Menor preço</option>
              <option>Maior preço</option>
              <option>Mais recentes</option>
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
              <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
              </svg>
            </div>
          </div>
        </div>
      </div>

      <!-- Content Grid -->
      <div class="flex flex-col md:flex-row gap-6">
        <!-- Sidebar Filters -->
        <div class="w-full md:w-1/4 bg-gray-900 text-white p-4 rounded-md">
          <h2 class="text-lg font-semibold mb-4">Filtrar por:</h2>

          <!-- Filter Categories -->
          <div class="space-y-3">
            <!-- Marca (Brand) -->
            <div class="border-b border-gray-700 pb-3">
              <div class="flex justify-between items-center cursor-pointer">
                <span class="text-sm">Marca</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
              </div>
            </div>

            <!-- Tipo (Type) -->
            <div class="border-b border-gray-700 pb-3">
              <div class="flex justify-between items-center cursor-pointer">
                <span class="text-sm">Tipo</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
              </div>
            </div>

            <!-- Ano (Year) -->
            <div class="border-b border-gray-700 pb-3">
              <div class="flex justify-between items-center cursor-pointer">
                <span class="text-sm">Ano</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
              </div>
            </div>

            <!-- Quilometragem (Mileage) -->
            <div class="border-b border-gray-700 pb-3">
              <div class="flex justify-between items-center cursor-pointer">
                <span class="text-sm">Quilometragem</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
              </div>
            </div>

            <!-- Preço (Price) -->
            <div class="border-b border-gray-700 pb-3">
              <div class="flex justify-between items-center cursor-pointer">
                <span class="text-sm">Preço</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
              </div>
            </div>

            <!-- Combustível (Fuel) -->
            <div class="border-b border-gray-700 pb-3">
              <div class="flex justify-between items-center cursor-pointer">
                <span class="text-sm">Combustível</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
              </div>
            </div>
          </div>
        </div>

        <!-- Car Listings -->
        <div class="w-full md:w-3/4">
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <!-- Car Card - This will be your component -->
            <!-- COMMENT: This car card can be extracted into a separate component -->

            <InventoryVehicleCard v-for="listing in this.listings"
                                  :key="listing.id"
                                  :listing="listing"
                                  :base-url="this.baseUrl"/>

            <!-- End of Car Card -->
          </div>

          <!-- Pagination -->
          <div class="flex justify-center items-center mt-8 gap-2">
            <button class="p-2 border border-gray-300 rounded-md">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
              </svg>
            </button>
            <span class="text-sm">Página 1 de 1</span>
            <button class="p-2 border border-gray-300 rounded-md">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
              </svg>
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- Footer with CTA Section -->
    <footer class="mt-auto">
      <!-- CTA Section -->
      <div class="bg-gray-900 text-white py-8">
        <div class="container mx-auto px-4 text-center">
          <h2 class="text-xl font-semibold mb-2">Não achou o carro que procurava?</h2>
          <p class="mb-4">Fale diretamente com um dos nossos vendedores:</p>
          <div class="flex justify-center items-center mb-6">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
            </svg>
            <span class="text-xl font-bold">(24) 2102-0221</span>
          </div>
          <button class="bg-lime-400 text-black font-medium py-3 px-6 rounded-md w-full max-w-md hover:bg-lime-500">
            Entrar em contato
          </button>
        </div>
      </div>
    </footer>
  </div>
</template>

<style scoped>

</style>