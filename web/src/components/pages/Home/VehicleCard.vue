<script>
export default {
  name: "VehicleCard",
  props: { listing: Object, baseUrl: String },
  computed: {
    formattedPrice() {
      const [integerPart, decimalPart] = this.listing.price.toString().split('.');

      const formattedInteger = integerPart.replace(/\B(?=(\d{3})+(?!\d))/g, '.');

      return {
        integer: formattedInteger,
        decimal: decimalPart ? decimalPart : '00' // Default to '00' if no decimal part
      };
    },
    imageArray() {
      return this.listing.vehicle.images.map(image => `${this.baseUrl}${image.url}`)
    }
  }
}
</script>

<template>
  <div class="max-w-md min-h-96 rounded-2xl bg-gray-100 shadow-md overflow-hidden">
    <!-- Card Header with Car Title -->
    <div class="p-4 min-h-24 flex items-center justify-center text-center">
      <h2 class="text-2xl font-bold text-[#003366]">
        <router-link :to="`/estoque/${listing.id}`">
          {{ listing.vehicle.make }} {{listing.vehicle.model}}
        </router-link>
      </h2>
    </div>

    <!-- Car Image - PLACEHOLDER -->
    <div class="relative h-64 bg-gray-200">
      <router-link :to="`/estoque/${listing.id}`">
        <img
            :src="imageArray[0]"
            alt="Volkswagen Golf Variant"
            class="w-full h-full object-cover"
        />
      </router-link>
    </div>

    <!-- Car Details -->
    <div class="flex justify-center items-center gap-2 py-3 px-4 border-t border-b border-gray-200 text-gray-700">
      <span>{{ listing.vehicle.model_year }}</span>
      <span class="h-1.5 w-1.5 rounded-full bg-gray-500">&nbsp;</span>
      <span>{{ listing.vehicle.mileage }}</span>
      <span class="h-1.5 w-1.5 rounded-full bg-gray-500">&nbsp;</span>
      <span>{{ listing.vehicle.fuel }}</span>
      <span class="h-1.5 w-1.5 rounded-full bg-gray-500">&nbsp;</span>
      <span>{{ listing.vehicle.transmission }}</span>
    </div>

    <!-- Price Section -->
    <div class="p-4 text-center">
      <p class="text-gray-500 line-through text-sm">de R$ {{ formattedPrice.integer }},{{ formattedPrice.decimal }}</p>
      <router-link :to="`/estoque/${listing.id}`">
        <p class="text-[#003366] text-3xl font-bold">
          R$ <span class="text-4xl">{{ formattedPrice.integer }}</span><span class="text-2xl">,{{ formattedPrice.decimal }}</span>
        </p>
      </router-link>
    </div>
  </div>
</template>

<style scoped>

</style>