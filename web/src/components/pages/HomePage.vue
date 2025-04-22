<script>

import Banner from "../banner.vue";
import VehicleCard from "../VehicleCard.vue";

export default {
  data() {
    return {
      make: "Volkswagen",
      model: "Golf Variant Highline 1.4 TSI",
      year: 2018,
      fuel: "Gasolina",
      transmission: "Automático",
      mileage: 1999999,
      price: 1999999,
      image: "http://localhost:8083/images/1516367486313.jpg"
    }
  },
  components: {
    Banner,
    VehicleCard,
  }
}

</script>

<template>
  <banner/>
  <hr>
  <div class="container mx-auto flex items-center justify-center p-12">
    <h1 class="text-4xl text-bold text-secondary text-center">Veículos em destaque</h1>
    <hr>
    <vehicle-card :make :model :fuel :transmission :mileage :price :year :image/>
  </div>
</template>

<style scoped>

</style>