<script>
export default {
  name: "VehicleCard",
  props: { listing: Array },
  computed: {
    formattedPrice() {
      const [integerPart, decimalPart] = this.listing.price.toString().split('.');

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
  <div class="max-w-md rounded-2xl bg-gray-50 shadow-md overflow-hidden">
    <!-- Card Header with Car Title -->
    <div class="p-4 bg-gray-50 text-center">
      <h2 class="text-2xl font-bold text-[#003366]">
        {{ listing.vehicle.make }} {{listing.vehicle.model}}
      </h2>
    </div>

    <!-- Car Image -->
    <div class="relative h-64 bg-gray-200">
      <img
          :src="listing.vehicle.images[4]"
          alt="Volkswagen Golf Variant"
          class="w-full h-full object-cover"
      />
    </div>

    <!-- Car Details -->
    <div class="flex justify-center items-center gap-2 py-3 px-4 border-t border-b border-gray-200 text-gray-700">
      <span>{{ vehicle.year }}</span>
      <span class="h-1.5 w-1.5 rounded-full bg-gray-500">&nbsp;</span>
      <span>{{ vehicle.mileage }}</span>
      <span class="h-1.5 w-1.5 rounded-full bg-gray-500">&nbsp;</span>
      <span>{{ vehicle.fuel }}</span>
      <span class="h-1.5 w-1.5 rounded-full bg-gray-500">&nbsp;</span>
      <span>{{ vehicle.transmission }}</span>
    </div>

    <!-- Price Section -->
    <div class="p-4 text-center">
      <p class="text-gray-500 line-through text-sm">de R$ {{ formattedPrice.integer }},{{ formattedPrice.decimal }}</p>
      <p class="text-[#003366] text-3xl font-bold">
        R$ <span class="text-4xl">{{ formattedPrice.integer }}</span><span class="text-2xl">,{{ formattedPrice.decimal }}</span>
      </p>
    </div>
  </div>
</template>

<style scoped>

</style>