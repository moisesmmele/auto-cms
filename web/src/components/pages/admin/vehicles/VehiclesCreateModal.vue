<script>
import notie from "notie/dist/notie.js";

export default {
  name: "VehiclesCreateModal",
  props: {
    token: { type: String, required: true },
    resource: { type: String, required: true },
  },
  data() {
    return {
      description: '',
      model: '',
      license_plate: '',
      vin: 'KNDPC3A24D7494688',
      model_year: '',
      mileage: '',
      selectedMakeId: null,
      selectedChassisId: null,
      selectedColorId: null,
      selectedGearboxId: null,
      selectedFuelId: null,
      SelectedImagesId: [18],
      selectedAccessoriesId: [1, 2, 3, 4, 5],
      encodedImages: [],

      availableMakes: [],
      availableTransmissions: [],
      availableColors: [],
      availableChassis: [],
      availableFuels: [],
      availableAccessories: [{ id:1, label: 'Teto Solar' }, { id:2, label: 'Vidro Elétrico' }, { id:3, label: 'Multimídia' }]
    }
  },
  methods: {
    save() {
      const headers = new Headers()
      headers.append("Content-Type", "application/json")
      headers.append("Authorization", "Bearer " + this.token)

      let resource = this.resource
      const url = `http://localhost:8083/${resource}`;
      const method = "POST";

      let payload = {
        vin: this.vin,
        license_plate: this.license_plate,
        make_id: this.selectedMakeId,
        chassis_type_id: this.selectedChassisId,
        gearbox_type_id: this.selectedGearboxId,
        fuel_type_id: this.selectedFuelId,
        color_id: this.selectedColorId,
        model: this.model,
        model_year: this.model_year,
        mileage: this.mileage,
        description: this.description,
        accessories: this.selectedAccessoriesId,
        images: this.SelectedImagesId
      }

      const request = {
        method: method,
        headers: headers,
        body: JSON.stringify(payload)
      }
      console.log(JSON.stringify(payload))
      fetch(url, request)
          .then(response => response.json()
              .then(data => ({ ok: response.ok, data })))
          .then(({ ok, data }) => {
            if (!ok) {
              notie.alert({
                type: "error",
                text: `Não foi possível cadastrar veículo!`
              })
            } else {
              notie.alert({
                type: "success",
                text: `Veículo cadastrado com sucesso!`
              })
              this.toggle()
            }
          })
    },
    toggle() {
      console.log('event fired')
      this.$emit('closeCreateModal')
    },
    fetchMakes(){
      fetch("http://localhost:8083/makes")
          .then((res) => (res.json()))
          .then((data) => {this.availableMakes = data})
    },
    fetchGearboxes(){
      fetch("http://localhost:8083/gearboxes")
          .then((res) => (res.json()))
          .then((data) => {this.availableTransmissions = data})
    },
    fetchColors(){
      fetch("http://localhost:8083/colors")
          .then((res) => (res.json()))
          .then((data) => {this.availableColors = data})
    },
    fetchChassis(){
      fetch("http://localhost:8083/chassis")
          .then((res) => (res.json()))
          .then((data) => {this.availableChassis = data})
    },
    fetchFuels(){
      fetch("http://localhost:8083/fuels")
          .then((res) => (res.json()))
          .then((data) => {this.availableFuels = data})
    }
  },
  mounted() {
    this.fetchMakes()
    this.fetchFuels()
    this.fetchGearboxes()
    this.fetchChassis()
    this.fetchColors()
  }
}
</script>

<template>
  <Teleport to="body">
    <div class="fixed inset-0 flex items-center justify-center z-5">
      <div class="absolute inset-0 bg-black/30 backdrop-blur-sm" @click="toggle"></div>

      <div class="relative w-full max-w-4xl bg-white rounded-md shadow-lg overflow-hidden">
        <div class="bg-secondary text-white px-4 py-2.5 flex justify-between items-center">
          <h3 class="text-lg font-medium">Novo Veículo</h3>
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
          <h2 class="text-xl text-gray-500 font-medium mb-4">Dados do veículo</h2>

          <div class="grid grid-cols-1 gap-x-6 gap-y-4">
            <div class="flex items-center">
              <label class="w-28 text-gray-500">Código:</label>
              <span class="font-medium"> 999 </span>
            </div>

            <div class="flex items-center justify-end md:justify-start">
              <label class="w-28 text-gray-500">Cadastro:</label>
              <span class="font-medium"> data </span>
            </div>

            <div class="flex items-center">
              <label class="w-28 text-gray-500">Marca:</label>
              <div class="relative w-full max-w-[200px]">
                <select v-model="this.selectedMakeId" class="w-full appearance-none border rounded px-3 py-1 pr-8 bg-white">
                  <option v-for="make in availableMakes" :key="make.id" :value="make.id">{{make.label}}</option>
                </select>
                <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                  <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                  </svg>
                </div>
              </div>
            </div>

            <div class="flex items-center col-span-1 md:col-span-2">
              <label class="w-28 text-gray-500">Modelo:</label>
              <input v-model="this.model" type="text" class="flex-1 border rounded px-3 py-1" />
            </div>

            <div class="flex items-center">
              <label class="w-28 text-gray-500">Ano:</label>
              <input v-model="this.model_year" type="text" class="w-full max-w-[200px] border rounded px-3 py-1" />
            </div>

            <div class="flex items-center">
              <label class="w-38 text-gray-500">Quilometragem:</label>
              <input v-model="this.mileage" type="text" class="w-full max-w-[200px] border rounded px-3 py-1" />
            </div>

            <div class="flex items-center">
              <label class="w-28 text-gray-500">Placa:</label>
              <input v-model="this.license_plate" type="text" class="w-full max-w-[200px] border rounded px-3 py-1" />
            </div>

            <div class="flex items-center">
              <label class="w-38 text-gray-500">Transmissão:</label>
              <div class="relative w-full max-w-[200px]">
                <select v-model="this.selectedGearboxId" class="w-full appearance-none border rounded px-3 py-1 pr-8 bg-white">
                  <option v-for="transmission in availableTransmissions" :key="transmission.id" :value="transmission.id">{{transmission.label}}</option>

                </select>
                <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                  <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                  </svg>
                </div>
              </div>
            </div>

            <div class="flex items-center">
              <label class="w-28 text-gray-500">Cor:</label>
              <div class="relative w-full max-w-[200px]">
                <select v-model="selectedColorId" class="w-full appearance-none border rounded px-3 py-1 pr-8 bg-white">
                  <option v-for="color in availableColors" :key="color.id" :value="color.id">{{color.label}}</option>

                </select>
                <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                  <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                  </svg>
                </div>
              </div>
            </div>

            <div class="flex items-center">
              <label class="w-38  text-gray-500">Carroceria:</label>
              <div class="relative w-full max-w-[200px]">
                <select v-model="this.selectedChassisId" class="w-full appearance-none border rounded px-3 py-1 pr-8 bg-white">
                  <option v-for="chassis in availableChassis" :key="chassis.id" :value="chassis.id">{{chassis.label}}</option>
                </select>
                <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                  <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                  </svg>
                </div>
              </div>
            </div>

            <div class="flex items-center">
              <label class="w-28 text-gray-500">Combustível:</label>
              <div class="relative w-full max-w-[200px]">
                <select v-model="selectedFuelId" class="w-full appearance-none border rounded px-3 py-1 pr-8 bg-white">
                  <option v-for="fuel in availableFuels" :key="fuel.id" :value="fuel.id">{{fuel.label}}</option>
                </select>
                <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                  <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                  </svg>
                </div>
              </div>
            </div>
          </div>

          <!-- Highlights and Options Section -->
          <h2 class="text-xl text-gray-500 font-medium mt-8 mb-4">Destaques e opcionais</h2>

          <div class="relative">
            <div class="flex items-center border rounded bg-white px-3 py-2">
              <svg class="w-5 h-5 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
              </svg>
              <div class="flex flex-wrap gap-2 flex-1">
                <div v-for="accessory in availableAccessories" :key="accessory.id"
                     class="flex items-center bg-gray-800 text-white text-sm px-2 py-1 rounded">
                  {{ accessory.label }}
                  <button @click="null" class="ml-1 text-white hover:text-gray-300">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                  </button>
                </div>
                <input type="text" placeholder="Buscar opcionais..."
                       class="flex-1 min-w-[150px] outline-none"
                       @keydown.enter="null" />
              </div>
            </div>
          </div>

          <!-- Photos Section -->
          <div class="mt-8">
            <div class="flex justify-between items-center mb-4">
              <h2 class="text-xl text-gray-500 font-medium">Fotos</h2>
              <button class="bg-lime-400 hover:bg-lime-500 text-black font-medium px-4 py-1 rounded">
                Inserir
              </button>
            </div>

            <div class="relative">
              <div class="flex overflow-x-auto gap-2 pb-2">
                <div v-for="(photo, index) in this.SelectedImagesId" :key="index" class="relative min-w-[150px] h-[100px] flex-shrink-0">
                  <img src="https://placehold.co/600x400/png" :alt="`Vehicle photo ${index + 1}`" class="w-full h-full object-cover" />

                  <!-- Controls overlay for the second image -->
                  <div v-if="index === 1" class="absolute inset-0 bg-black bg-opacity-50 flex justify-center items-center gap-2">
                    <button class="bg-lime-400 hover:bg-lime-500 w-8 h-8 rounded-full flex items-center justify-center">
                      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                      </svg>
                    </button>
                    <button class="bg-lime-400 hover:bg-lime-500 w-8 h-8 rounded-full flex items-center justify-center">
                      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                      </svg>
                    </button>
                  </div>
                </div>
              </div>

              <!-- Navigation arrows -->
              <button class="absolute left-0 top-1/2 -translate-y-1/2 -ml-4 bg-white rounded-full shadow-md w-8 h-8 flex items-center justify-center">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
              </button>
              <button class="absolute right-0 top-1/2 -translate-y-1/2 -mr-4 bg-white rounded-full shadow-md w-8 h-8 flex items-center justify-center">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </Teleport>
</template>

<style scoped>
/* optional scoped styles */
</style>
