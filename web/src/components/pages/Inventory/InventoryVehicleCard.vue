<script>
export default {
  name: "InventoryVehicleCard",
  props: {
    listing: Object,
    baseUrl: String,
  },
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
  <div class="border border-gray-200 rounded-md overflow-hidden bg-white">
    <div class="relative">
      <router-link :to="`/estoque/${listing.id}`">
        <img
            :src="imageArray[4]"
            alt="Volkswagen Golf TSI Variant Highline"
            class="w-full h-48 object-cover"
        />
      </router-link>
      <h3 class="text-center font-medium py-2 bg-white">
        <router-link :to="`/estoque/${listing.id}`">
          {{ listing.vehicle.make }} {{ listing.vehicle.model }}
        </router-link>
      </h3>
    </div>
    <div class="flex flex-col items-center border-t border-t-gray-200 rounded-b-md">
      <div class="flex justify-between w-full items-center gap-3 text-xs text-gray-600 pt-2 pb-2 pr-8 pl-8 border-b border-b-gray-200">
        <div class="flex items-center gap-1">
          <span>{{ listing.vehicle.model_year }}</span>
        </div>
        <span class="h-1.5 w-1.5 rounded-full bg-gray-500">&nbsp;</span>
        <div class="flex items-center gap-1">
          <span>{{ listing.vehicle.mileage }} km</span>
        </div>
        <span class="h-1.5 w-1.5 rounded-full bg-gray-500">&nbsp;</span>
        <div class="flex items-center gap-1">
          <span>{{ listing.vehicle.fuel }}</span>
        </div>
        <span class="h-1.5 w-1.5 rounded-full bg-gray-500">&nbsp;</span>
        <div class="flex items-center gap-1">
          <span>{{ listing.vehicle.transmission }}</span>
        </div>
      </div>
      <div class="flex items-center justify-center text-center min-h-12 w-full">
        <router-link :to="`/estoque/${listing.id}`">
          <p class="text-2xl font-bold text-secondary">
            <span class="text-sm">R$</span>
            {{ formattedPrice.integer }}<span class="text-lg">,{{ formattedPrice.decimal }}</span>
          </p>
        </router-link>
      </div>
    </div>
  </div>
</template>

<style scoped>

</style>