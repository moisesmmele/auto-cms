<script>
import notie from "notie/dist/notie.js";

export default {
  name: "ListingsCreateModal",
  props: {
    token: { type: String, required: true },
    resource: { type: String, required: true },
  },
  data() {
    return {
      vehicleId: '',
      price: '',
    }
  },
  methods: {
    save() {
      console.log('save clicked')
      const headers = new Headers()
      headers.append('Content-Type', 'application/json')
      headers.append('Authorization', 'Bearer ' + this.token)
      const request = {
        method: 'POST',
        headers: headers,
        body: JSON.stringify({
          vehicle_id: this.vehicleId,
          price: this.price
        })
      }
      fetch('http://localhost:8083/listings', request)
      this.$emit('closeCreateModal')
    },
    toggle() {
      this.$emit('closeCreateModal')
    },
  }
}
</script>

<template>
  <Teleport to="body">
    <div class="fixed inset-0 flex items-center justify-center z-5">
      <div class="absolute inset-0 bg-black/30 backdrop-blur-sm" @click="toggle"></div>

      <div class="relative w-full max-w-4xl bg-white rounded-md shadow-lg overflow-hidden">
        <div class="bg-secondary text-white px-4 py-2.5 flex justify-between items-center">
          <h3 class="text-lg font-medium">Novo Anúncio</h3>
          <div class="flex space-x-1">
            <button @click="save" class="bg-primary hover:bg-green-400 p-1.5 rounded">
              <!-- save icon -->
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path d="M5 3h14a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2z"/>
                <path d="M9 3v5h6V3"/>
                <rect x="8" y="14" width="8" height="4" rx="1"/>
              </svg>
            </button>

            <button @click="toggle" class="bg-primary hover:bg-red-400 p-1.5 rounded">
              <!-- close icon -->
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <line x1="18" y1="6" x2="6" y2="18"/>
                <line x1="6" y1="6" x2="18" y2="18"/>
              </svg>
            </button>
          </div>
        </div>

        <!-- MODAL BODY -->
        <div class="bg-gray-100 p-6 rounded-lg">
          <!-- Vehicle Data Section -->
          <h2 class="text-xl text-gray-500 font-medium mb-4">Dados do Anúncio</h2>
          <div class="flex items-center col-span-1 md:col-span-2 pb-3">
            <label class="w-28 text-gray-500">Código do veículo:</label>
            <input v-model="vehicleId" type="text" class="flex-1 border rounded px-3 py-1" />
          </div>
          <div class="flex items-center col-span-1 md:col-span-2">
            <label class="w-28 text-gray-500">Preço:</label>
            <input v-model="this.price" type="text" class="flex-1 border rounded px-3 py-1" />
          </div>

        </div>
      </div>
    </div>
  </Teleport>
</template>

<style scoped>
/* optional scoped styles */
</style>
