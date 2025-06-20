<script>

export default {
  data() {
    return {
      listing: Object,
      baseUrl: `${import.meta.env.VITE_API_URL}`
    }
  },
  beforeMount() {
    fetch(`${import.meta.env.VITE_API_URL}/listings/${this.$route.params.id}`)
        .then((response) => (response.json()))
        .then((response) => {
          this.listing = response
        })
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
  <div class="bg-white">
    <!-- Main Content Area -->
    <div class="container mx-auto px-4 py-8">
      <!-- Car Details Section -->
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Car Info and Images - Takes 2/3 of the space on large screens -->
        <div class="lg:col-span-2">
          <!-- Car Title and Price Section -->
          <div class="bg-[#002b36] text-white p-4 rounded-t-lg flex justify-between items-center">
            <div>
              <p class="text-sm">{{listing.vehicle.make}}</p>
              <h1 class="text-2xl font-bold">{{listing.vehicle.model}}</h1>
            </div>
            <div class="text-right">
              <span class="text-sm text-[#c1ff00]">R$</span>
              <span class="text-4xl font-bold text-[#c1ff00]">{{formattedPrice.integer}}</span>
              <span class="text-xl text-[#c1ff00]">,{{formattedPrice.decimal}}</span>
            </div>
          </div>

          <!-- Main Image Carousel -->
          <div class="relative bg-gray-200">
            <div class="w-full h-[400px] relative">
              <img
                  :src="imageArray[0]"
                  alt="Volkswagen Golf Variant Highline"
                  class="w-full h-full object-contain"
              />

              <!-- Navigation Arrows -->
              <button class="absolute left-2 top-1/2 -translate-y-1/2 bg-white/30 p-2 rounded-full">
                <span class="sr-only">Previous</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
              </button>
              <button class="absolute right-2 top-1/2 -translate-y-1/2 bg-white/30 p-2 rounded-full">
                <span class="sr-only">Next</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
              </button>

              <!-- Dots Navigation -->
              <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex space-x-2">
                <button class="w-3 h-3 rounded-full bg-white"></button>
                <button class="w-3 h-3 rounded-full bg-gray-400"></button>
                <button class="w-3 h-3 rounded-full bg-gray-400"></button>
                <button class="w-3 h-3 rounded-full bg-gray-400"></button>
                <button class="w-3 h-3 rounded-full bg-gray-400"></button>
                <button class="w-3 h-3 rounded-full bg-gray-400"></button>
                <button class="w-3 h-3 rounded-full bg-gray-400"></button>
                <button class="w-3 h-3 rounded-full bg-gray-400"></button>
              </div>
            </div>

            <!-- Thumbnails -->
            <div class="grid grid-cols-4">
              <div class="h-36">
                <img
                    :src="imageArray[0]"
                    alt="Thumbnail 1"
                    class="w-full h-full object-cover"
                />
              </div>
              <div class="h-36">
                <img
                    :src="imageArray[1]"
                    alt="Thumbnail 2"
                    class="w-full h-full object-cover"
                />
              </div>
              <div class="h-36">
                <img
                    :src="imageArray[2]"
                    alt="Thumbnail 3"
                    class="w-full h-full object-cover"
                />
              </div>
              <div class="h-36">
                <img
                    :src="imageArray[3]"
                    alt="Thumbnail 4"
                    class="w-full h-full object-cover"
                />
              </div>
            </div>
          </div>

          <!-- Car Specifications -->
          <div class="bg-gray-100 p-4 grid grid-cols-5 gap-4 text-center border-b border-b-gray-300">
            <div class="flex flex-col items-center">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
              </svg>
              <span class="text-base font-medium">{{listing.vehicle.model_year}}</span>
            </div>
            <div class="flex flex-col items-center">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
              </svg>
              <span class="text-base font-medium">{{listing.vehicle.mileage}} km</span>
            </div>
            <div class="flex flex-col items-center">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
              </svg>
              <span class="text-base font-medium">{{ listing.vehicle.transmission }}</span>
            </div>
            <div class="flex flex-col items-center">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01" />
              </svg>
              <span class="text-base font-medium">{{listing.vehicle.color}}</span>
            </div>
            <div class="flex flex-col items-center">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
              </svg>
              <span class="text-base font-medium">{{listing.vehicle.fuel}}</span>
            </div>
          </div>

          <!-- Car Features -->
          <div class="bg-gray-100 p-6 grid grid-cols-1 md:grid-cols-4 gap-4">
            <div v-for="accessory in listing.vehicle.accessories" class="flex items-center">
              <div class="w-6 h-6 rounded-full bg-gray-200 flex items-center justify-center mr-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
              </div>
              <span>{{accessory.label}}</span>
            </div>
          </div>
          <!-- Car Description -->
          <div class="bg-gray-100 p-6 text-sm text-gray-600 rounded-b-md border-t border-t-gray-300">
            <p>
              {{listing.vehicle.description}}
            </p>
          </div>
        </div>

        <!-- Contact Form - Takes 1/3 of the space on large screens -->
        <div class="lg:col-span-1">
          <div class="bg-white p-6 rounded-lg shadow-sm">
            <h2 class="text-3xl font-bold text-gray-700 mb-2">Gostou?</h2>
            <p class="text-gray-600 mb-6">
              Entre em contato com a nossa equipe de vendas agora mesmo!
            </p>

            <form>
              <div class="space-y-4">
                <div>
                  <label for="name" class="sr-only">Nome</label>
                  <input
                      type="text"
                      id="name"
                      placeholder="Nome *"
                      class="w-full p-3 border border-gray-300 rounded-md"
                      required
                  />
                </div>

                <div>
                  <label for="email" class="sr-only">Email</label>
                  <input
                      type="email"
                      id="email"
                      placeholder="Email *"
                      class="w-full p-3 border border-gray-300 rounded-md"
                      required
                  />
                </div>

                <div>
                  <label for="phone" class="sr-only">Telefone</label>
                  <input
                      type="tel"
                      id="phone"
                      placeholder="Telefone *"
                      class="w-full p-3 border border-gray-300 rounded-md"
                      required
                  />
                </div>

                <div>
                  <label for="cpf" class="sr-only">CPF</label>
                  <input
                      type="text"
                      id="cpf"
                      placeholder="CPF"
                      class="w-full p-3 border border-gray-300 rounded-md"
                  />
                </div>

                <div>
                  <label for="interest" class="sr-only">Estou interessado em:</label>
                  <div class="relative">
                    <select
                        id="interest"
                        class="w-full p-3 border border-gray-300 rounded-md appearance-none bg-white"
                    >
                      <option value="" disabled selected>Financiar</option>
                      <option value="financiar">Financiar</option>
                      <option value="comprar">Comprar à vista</option>
                      <option value="informacoes">Mais informações</option>
                    </select>
                    <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                      <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                      </svg>
                    </div>
                  </div>
                </div>

                <div>
                  <label for="message" class="sr-only">Mensagem</label>
                  <textarea
                      id="message"
                      placeholder="Mensagem"
                      rows="4"
                      class="w-full p-3 border border-gray-300 rounded-md"
                  ></textarea>
                </div>

                <button
                    type="submit"
                    class="w-full py-4 px-6 bg-[#c1ff00] text-black font-bold rounded-md hover:bg-[#a8e600] transition-colors"
                >
                  Enviar mensagem
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>

</style>