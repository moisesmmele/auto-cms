<script>
export default {
  name: "InventoryVehicleCard",
  props: {
    vehicle: Object
  },
  computed: {
    formattedPrice() {
      const [integerPart, decimalPart] = this.vehicle.price.toString().split('.');

      const formattedInteger = integerPart.replace(/\B(?=(\d{3})+(?!\d))/g, '.');

      return {
        integer: formattedInteger,
        decimal: decimalPart ? decimalPart : '00' // Default to '00' if no decimal part
      };
    }
  }
}
</script>

<template>
  <div class="border border-gray-200 rounded-md overflow-hidden bg-white">
    <div class="relative">
      <img
          :src="vehicle.image"
          alt="Volkswagen Golf TSI Variant Highline"
          class="w-full h-48 object-cover"
      />
      <h3 class="text-center font-medium py-2 bg-white">{{vehicle.make}} {{vehicle.model}}</h3>
    </div>
    <div class="p-3">
      <div class="flex justify-between text-xs text-gray-600 mb-3">
        <div class="flex items-center gap-1">
          <span>{{vehicle.year}}</span>
        </div>
        <div class="flex items-center gap-1">
          <span>{{vehicle.mileage}} km</span>
        </div>
        <div class="flex items-center gap-1">
          <span>{{vehicle.fuel}}</span>
        </div>
        <div class="flex items-center gap-1">
          <span>{{vehicle.transmission}}</span>
        </div>
      </div>
      <div class="text-center">
        <p class="text-lg font-bold">{{formattedPrice.integer}}<span class="text-xs">,{{formattedPrice.decimal}}</span></p>
      </div>
    </div>
  </div>
</template>

<style scoped>

</style>