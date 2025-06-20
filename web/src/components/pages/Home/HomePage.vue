<script>

import Banner from "./banner.vue";
import VehicleCard from "./VehicleCard.vue";
import FeaturedVehicles from "./featuredVehicles.vue";
import HomeContactForm from "./HomeContactForm.vue";

export default {
  data() {
    return {
      vehicles: [],
      listings: [],
      bannerImages: [],
    }
  },
  components: {
    HomeContactForm,
    FeaturedVehicles,
    Banner,
    VehicleCard,
  },
  beforeMount() {
    fetch(`${import.meta.env.VITE_API_URL}/banners`)
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