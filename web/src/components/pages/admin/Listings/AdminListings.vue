<script>
import security from "../../../../security.js";
import {useUserStore} from "../../../../stores/useUserStore.js";
import ListingsCreateModal from "./ListingsCreateModal.vue";

export default {
  components: {ListingsCreateModal},
  data() {
    return {
      listings: Object,
      showCreateModal: false,
      showUpdateModal: false,
    }
  },
  computed: {
    userStore: function () {
      return useUserStore()
    },
    results: function () {
      return this.listings.length
    },
  },
  beforeMount() {

    const headers = new Headers();
    headers.append("Content-Type", "application/json")
    headers.append("Authorization", "Bearer " + this.userStore.user.token)

    const request = {
      method: "GET",
      headers: headers
    }

    fetch(`${import.meta.env.VITE_API_URL}/listings`, request)
        .then((response) => (response.json()))
        .then((response) => {
          this.listings = response.listings
        })
  },
  methods: {
    formatMoney: function (number) {
      let [integerPart, decimalPart] = number.toFixed(2).split(".");
      integerPart = integerPart.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
      return `${integerPart},${decimalPart}`;
    },
    openCreateModal() {
      this.showCreateModal = true;
    },
    closeCreateModal() {
      this.showCreateModal = false;
    }
  }
}
</script>
<template>
  <main class="bg-gray-100">
    <!-- Main content container -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
      <!-- Anúncios header section -->
      <div class="bg-secondary text-white rounded-t-md p-4 flex items-center justify-between">
        <div class="flex items-center gap-4">
          <h1 class="text-2xl font-bold">Anúncios</h1>
          <span class="text-sm">{{ results }} resultados</span>
        </div>
        <div class="flex items-center gap-3">
          <div class="relative rounded-md border border-gray-300">
            <input
                type="text"
                placeholder="Buscar"
                class="pl-8 pr-4 py-2 rounded-md w-64 text-white focus:outline-none"
            />
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
              <svg
                  xmlns="http://www.w3.org/2000/svg"
                  class="h-4 w-4 accent-white"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
              >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
                />
              </svg>
            </div>
          </div>
          <div class="relative">
            <select
                class="appearance-nones text-gray-300 py-2 pl-4 pr-8 border border-gray-300 rounded-md focus:outline-none"
            >
              <option>Todos</option>
              <option>Ativos</option>
              <option>Inativos</option>
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-secondary">
              <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
              </svg>
            </div>
          </div>
          <button @click="openCreateModal"
              class="bg-primary text-secondary font-medium py-2 px-4 rounded-md transition-colors"
          >
            Novo Anúncio
          </button>
        </div>
      </div>

      <!-- Table section -->
      <div class="overflow-x-auto">
        <table class="min-w-full bg-white">
          <!-- Table header -->
          <thead>
          <tr class="bg-gray-200 border-b border-b-gray-300">
            <th class="py-3 px-4 text-center font-medium text-gray-600">Código</th>
            <th class="py-3 px-4 text-center font-medium text-gray-600">Carro</th>
            <th class="py-3 px-4 text-center font-medium text-gray-600">Placa</th>
            <th class="py-3 px-4 text-center font-medium text-gray-600">Valor</th>
            <th class="py-3 px-4 text-center font-medium text-gray-600">Promoção</th>
            <th class="py-3 px-4 text-center font-medium text-gray-600">Visualizações</th>
            <th class="py-3 px-4 text-center font-medium text-gray-600">Ações</th>
          </tr>
          </thead>
          <!-- Table body -->
          <tbody>
          <tr v-for="listing in listings" :key="listing.id" class="border-t bg-gray-200 border-t-gray-300 hover:bg-gray-300">
            <td class="py-3 px-4 text-gray-700 text-center">{{ listing.id }}</td>
            <td class="py-3 px-4 text-gray-700 text-center">{{ listing.vehicle.make }} {{ listing.vehicle.model}} {{ listing.vehicle.model_year}}</td>
            <td class="py-3 px-4 text-gray-700 text-center">{{ listing.vehicle.license_plate }}</td>
            <td class="py-3 px-4 text-gray-700 text-center">{{ formatMoney(listing.price) }}</td>
            <td class="py-3 px-4 text-gray-700 text-center"> TO DO </td>
            <td class="py-3 px-4 text-gray-700 text-center"> TO DO </td>
            <td class="py-3 px-4 flex justify-center space-x-3">
              <button class="text-secondary">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-5 w-5"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >
                  <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M14 5l7 7m0 0l-7 7m7-7H3"
                  />
                </svg>
              </button>
              <button class="text-secondary">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-5 w-5"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >
                  <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                  />
                </svg>
              </button>
            </td>
          </tr>
          </tbody>
        </table>
      </div>
    </div>
    <listings-create-modal v-if="this.showCreateModal" resource="listings" :token="this.userStore.user.token" @closeCreateModal="closeCreateModal"/>
  </main>
</template>

<style>
/* You can add custom styles here if needed */
</style>