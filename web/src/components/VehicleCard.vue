<script>
export default {
  name: "VehicleCard",
  props: {
    make: String,
    model: String,
    fuel: String,
    year: Number,
    mileage: Number,
    transmission: String,
    price: Number,
    image: String,
  }
}
</script>

<template>
  <div class="max-w-md rounded-2xl bg-white shadow-md overflow-hidden">
    <!-- Card Header with Car Title -->
    <div class="p-4 bg-white text-center">
      <h2 class="text-2xl font-bold text-[#003366]">
        {{make}} {{model}}
      </h2>
    </div>

    <!-- Car Image -->
    <div class="relative h-64 bg-gray-200">
      <img
          :src="image"
          alt="Volkswagen Golf Variant"
          class="w-full h-full object-cover"
      />
    </div>

    <!-- Car Details -->
    <div class="flex justify-center items-center gap-2 py-3 px-4 border-t border-b border-gray-200 text-gray-700">
      <span>{{ year }}</span>
      <span class="h-1.5 w-1.5 rounded-full bg-gray-500"></span>
      <span>{{ mileage }}</span>
      <span class="h-1.5 w-1.5 rounded-full bg-gray-500"></span>
      <span>{{ fuel }}</span>
      <span class="h-1.5 w-1.5 rounded-full bg-gray-500"></span>
      <span>{{ transmission }}</span>
    </div>

    <!-- Price Section -->
    <div class="p-4 text-center">
      <p class="text-gray-500 line-through text-sm">de {{ price }}</p>
      <p class="text-[#003366] text-3xl font-bold">
        R$ <span class="text-4xl">{{ price }}</span>,<span class="text-2xl">00</span>
      </p>
    </div>
  </div>
</template>

<style scoped>

</style>