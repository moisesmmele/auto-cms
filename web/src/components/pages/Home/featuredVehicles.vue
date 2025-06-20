<script>
import VehicleCard from "./VehicleCard.vue";

export default {
  data() {
    return {
      listings: Array,
      baseUrl: `${import.meta.env.VITE_API_URL}`
    }
  },

  name: "featuredVehicles",
  beforeMount() {
    fetch(`${import.meta.env.VITE_API_URL}/listings`)
        .then((response) => (response.json()))
        .then( (response) => {
          this.listings = response.listings.slice(0, 4);
        })
  },
  components: {VehicleCard}
}
</script>

<template>
  <section class="max-w-8xl mx-auto px-4 py-8 sm:px-6 lg:px-8">
    <!-- Heading -->
    <h1 class="text-4xl font-bold text-center text-gray-800 mb-8">Veículos em destaque</h1>

    <!-- Vehicle Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
      <!-- Assuming you have a VehicleCard component -->
      <vehicle-card v-for="listing in listings" :key="listing.id" :listing="listing" :base-url="baseUrl"/>
    </div>

    <!-- Action Button -->
    <div class="flex justify-center">
      <router-link to="/estoque" class="text-center w-full max-w-xl py-3 px-6 bg-[#d6e600] hover:bg-[#c5d500] text-[#004080] font-bold text-xl rounded-md transition-colors duration-200">
        Conferir estoque
      </router-link>
    </div>
  </section>
</template>

<style scoped>

</style>