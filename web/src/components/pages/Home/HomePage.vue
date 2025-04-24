<script>

import Banner from "./banner.vue";
import VehicleCard from "./VehicleCard.vue";
import FeaturedVehicles from "./featuredVehicles.vue";
import HomeContactForm from "./HomeContactForm.vue";

export default {
  data() {
    let vehicles = [
      {
        id: 1,
        make: "Volkswagen",
        model: "Golf Variant Highline 1.4 TSI",
        year: 2018,
        fuel: "Gasolina",
        transmission: "Automático",
        mileage: 1999999,
        price: 1999999.99,
        image: "http://localhost:8083/images/1516495181425.jpg"
      },
      {
        id: 2,
        make: "Volkswagen",
        model: "Golf Variant Highline 1.4 TSI",
        year: 2018,
        fuel: "Gasolina",
        transmission: "Automático",
        mileage: 1999999,
        price: 1999999.99,
        image: "http://localhost:8083/images/1516495181425.jpg"
      },
      {
        id: 3,
        make: "Volkswagen",
        model: "Golf Variant Highline 1.4 TSI",
        year: 2018,
        fuel: "Gasolina",
        transmission: "Automático",
        mileage: 1999999,
        price: 1999999.99,
        image: "http://localhost:8083/images/1516495181425.jpg"
      },
      {
        id: 4,
        make: "Volkswagen",
        model: "Golf Variant Highline 1.4 TSI",
        year: 2018,
        fuel: "Gasolina",
        transmission: "Automático",
        mileage: 1999999,
        price: 1999999.99,
        image: "http://localhost:8083/images/1516495181425.jpg"
      }
    ]
    let listings
    let bannerImages
    return { vehicles, listings, bannerImages }
  },
  components: {
    HomeContactForm,
    FeaturedVehicles,
    Banner,
    VehicleCard,
  },
  beforeMount() {
    fetch('http://localhost:8083/images/banner/all')
        .then((response) => (response.json()))
        .then((response) => {
          this.bannerImages = response
        })
  }
}

</script>

<template>

  <banner :images="this.bannerImages" class="z-0"/>

  <hr>
  <div class="container flex mx-auto justify-between">
    <featured-vehicles :listings="this.listings" />
  </div>

  <banner :images="this.bannerImages" class="z-0"/>
  <home-contact-form/>
</template>

<style scoped>

</style>