<script>
export default {
  name: "AccessoryComponent",
  props: {
    availableAccessories: { type: Array, required: true },
  },
  data() {
    return {
      selectedAccessories: [],
      searchInput: '',
    };
  },
  methods: {
    search() {
      const query = this.searchInput.toLowerCase();
      this.filteredAccessories = this.availableAccessories.filter(item =>
          item.label.toLowerCase().includes(query)
      );
    },
    toggleAccessory(accessory) {
      const index = this.selectedAccessories.findIndex(item => item.id === accessory.id);
      if (index > -1) {
        this.selectedAccessories.splice(index, 1);
      } else {
        this.selectedAccessories.push(accessory);
        this.$emit('update:selectedAccessories', this.selectedAccessories)
      }
    },
  },
  watch: {
    searchInput: 'search',
  },
  computed: {
    filteredAccessories() {
      return this.availableAccessories.filter(item =>
          item.label.toLowerCase().includes(this.searchInput.toLowerCase())
      );
    },
  },
};
</script>

<template>
  <h2 class="text-xl text-gray-500 font-medium mt-8 mb-4">Destaques e opcionais</h2>

  <div class="relative">
    <div class="flex items-center border rounded bg-white px-3 py-2">
      <svg class="w-5 h-5 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
      </svg>
      <div class="flex flex-wrap gap-2 flex-1 relative">
        <div v-for="accessory in selectedAccessories" :key="accessory.id" class="flex items-center bg-gray-800 text-white text-sm px-2 py-1 rounded">
          {{ accessory.label }}
          <button @click="toggleAccessory(accessory)" class="ml-1 text-white hover:text-gray-300">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
          </button>
        </div>
        <input type="text" v-model="searchInput" placeholder="Buscar opcionais..." class="flex-1 min-w-[150px] outline-none mt-2 mb-4" />

        <ul v-if="searchInput && filteredAccessories.length"
            class="absolute top-full left-0 w-full bg-white border border-gray-300 rounded shadow-lg mt-1 z-10 max-h-60 overflow-y-auto">
          <li v-for="accessory in filteredAccessories" :key="accessory.id"
              @click="toggleAccessory(accessory)"
              class="px-4 py-2 text-sm text-gray-800 hover:bg-gray-100 cursor-pointer">
            {{ accessory.label }}
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>

<style scoped>
/* Add your custom styles here */
</style>
