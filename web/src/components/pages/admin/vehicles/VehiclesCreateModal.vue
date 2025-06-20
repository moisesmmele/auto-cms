<script>
import notie from "notie/dist/notie.js";
import AccessoryComponent from "./AccessoryComponent.vue";
import PhotosComponent from "./PhotosComponent.vue";

export default {
  name: "VehiclesCreateModal",
  components: {AccessoryComponent, PhotosComponent},
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
      imagesIds: [],
      selectedAccessoriesId: [],

      availableMakes: [],
      availableTransmissions: [],
      availableColors: [],
      availableChassis: [],
      availableFuels: [],
      availableAccessories: [],

      photos: [],
      selectedAccessories: [],
    }
  },
  methods: {
    async save() {
      await this.uploadImages()

      const headers = new Headers()
      headers.append("Content-Type", "application/json")
      headers.append("Authorization", "Bearer " + this.token)

      let resource = this.resource
      const url = `${import.meta.env.VITE_API_URL}/${resource}`;
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
        images: this.imagesIds,
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
    async uploadImages() {
      console.log("Init method")
      const headers = new Headers()
      headers.append("Authorization", "Bearer " + this.token)
      const formData = new FormData()

      Array.from(this.photos).forEach(file => {
        formData.append(`${file.name}`, file);
      });

      const request = {
        method: 'POST',
        headers: headers,
        body: formData
      }

      console.log("init fetch")
      console.log("FormData: ", formData)
      return fetch(`${import.meta.env.VITE_API_URL}/images/uploadTest`, request)
          .then(res => res.json())
          .then(data => {
            data.forEach(item => {
              this.imagesIds.push(item.id)
            })
          })
    },
    toggle() {
      console.log('event fired')
      this.$emit('closeCreateModal')
    },
    fetchMakes(){
      fetch(`${import.meta.env.VITE_API_URL}/makes`)
          .then((res) => (res.json()))
          .then((data) => {this.availableMakes = data})
    },
    fetchGearboxes(){
      fetch(`${import.meta.env.VITE_API_URL}/gearboxes`)
          .then((res) => (res.json()))
          .then((data) => {this.availableTransmissions = data})
    },
    fetchColors(){
      fetch(`${import.meta.env.VITE_API_URL}/colors`)
          .then((res) => (res.json()))
          .then((data) => {this.availableColors = data})
    },
    fetchChassis(){
      fetch(`${import.meta.env.VITE_API_URL}/chassis`)
          .then((res) => (res.json()))
          .then((data) => {this.availableChassis = data})
    },
    fetchFuels(){
      fetch(`${import.meta.env.VITE_API_URL}/fuels`)
          .then((res) => (res.json()))
          .then((data) => {this.availableFuels = data})
    },
    fetchAccessories(){
      fetch(`${import.meta.env.VITE_API_URL}/accessories`)
          .then((res) => (res.json()))
          .then((data) => {this.availableAccessories = data})
    },

  },
  mounted() {
    this.fetchMakes()
    this.fetchFuels()
    this.fetchGearboxes()
    this.fetchChassis()
    this.fetchColors()
    this.fetchAccessories()
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
          <AccessoryComponent :available-accessories="availableAccessories" v-model:selectedAccessories="selectedAccessories"/>

          <!-- Photos Section -->
          <PhotosComponent v-model="photos"/>
        </div>
      </div>
    </div>
  </Teleport>
</template>

<style scoped>
/* optional scoped styles */
</style>
