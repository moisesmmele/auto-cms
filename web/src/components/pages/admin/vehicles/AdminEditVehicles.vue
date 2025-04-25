<template>
  <div class="max-w-6xl mx-auto px-4 py-6 bg-white">
    <!-- Car Section -->
    <div class="bg-gray-900 text-white p-4 rounded-t-lg flex justify-between items-center mb-6">
      <h2 class="text-xl font-semibold">Carro</h2>
      <div class="flex gap-2">
        <button class="bg-red-500 hover:bg-red-600 text-white px-4 py-1 rounded">Excluir</button>
        <button class="bg-lime-400 hover:bg-lime-500 text-gray-900 px-4 py-1 rounded">Salvar</button>
      </div>
    </div>

    <!-- Vehicle Data Section -->
    <div class="mb-8">
      <h3 class="text-lg text-gray-500 font-medium mb-4">Dados do veículo</h3>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4">
        <!-- Row 1 -->
        <div class="flex items-center">
          <label class="w-28 text-gray-500">Código:</label>
          <span class="text-gray-700">99999</span>
        </div>
        <div class="flex items-center">
          <label class="w-28 text-gray-500">Cadastro:</label>
          <span class="text-gray-700">01/02/2099 13:59</span>
        </div>

        <!-- Row 2 -->
        <div class="flex items-center">
          <label class="w-28 text-gray-500">Marca:</label>
          <div class="relative w-48">
            <select class="appearance-none border rounded w-full py-1 px-2 text-gray-700 leading-tight focus:outline-none focus:shadow-outline pr-8">
              <option>Volkswagen</option>
              <option>Toyota</option>
              <option>Honda</option>
              <option>Ford</option>
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
              <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
              </svg>
            </div>
          </div>
        </div>
        <div class="flex items-center">
          <label class="w-28 text-gray-500">Modelo:</label>
          <input type="text" value="Golf Variant Highline 1.4 TSI" class="border rounded py-1 px-2 w-full text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <!-- Row 3 -->
        <div class="flex items-center">
          <label class="w-28 text-gray-500">Ano:</label>
          <input type="text" value="2017" class="border rounded py-1 px-2 w-48 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>
        <div class="flex items-center">
          <label class="w-28 text-gray-500">Quilometragem:</label>
          <input type="text" value="1.199.999 km" class="border rounded py-1 px-2 w-48 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <!-- Row 4 -->
        <div class="flex items-center">
          <label class="w-28 text-gray-500">Placa:</label>
          <input type="text" value="XYZ1B38" class="border rounded py-1 px-2 w-48 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <!-- Row 5 -->
        <div class="flex items-center">
          <label class="w-28 text-gray-500">Transmissão:</label>
          <div class="relative w-48">
            <select class="appearance-none border rounded w-full py-1 px-2 text-gray-700 leading-tight focus:outline-none focus:shadow-outline pr-8">
              <option>Automático</option>
              <option>Manual</option>
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
              <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
              </svg>
            </div>
          </div>
        </div>
        <div class="flex items-center">
          <label class="w-28 text-gray-500">Cor:</label>
          <div class="relative w-48">
            <select class="appearance-none border rounded w-full py-1 px-2 text-gray-700 leading-tight focus:outline-none focus:shadow-outline pr-8">
              <option>Branco</option>
              <option>Preto</option>
              <option>Prata</option>
              <option>Vermelho</option>
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
              <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
              </svg>
            </div>
          </div>
        </div>

        <!-- Row 6 -->
        <div class="flex items-center">
          <label class="w-28 text-gray-500">Carroceria:</label>
          <div class="relative w-48">
            <select class="appearance-none border rounded w-full py-1 px-2 text-gray-700 leading-tight focus:outline-none focus:shadow-outline pr-8">
              <option>Sedan</option>
              <option>Hatch</option>
              <option>SUV</option>
              <option>Pickup</option>
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
              <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
              </svg>
            </div>
          </div>
        </div>
        <div class="flex items-center">
          <label class="w-28 text-gray-500">Combustível:</label>
          <div class="relative w-48">
            <select class="appearance-none border rounded w-full py-1 px-2 text-gray-700 leading-tight focus:outline-none focus:shadow-outline pr-8">
              <option>Gasolina</option>
              <option>Diesel</option>
              <option>Flex</option>
              <option>Elétrico</option>
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
              <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
              </svg>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Highlights and Options Section -->
    <div class="mb-8">
      <h3 class="text-lg text-gray-500 font-medium mb-4">Destaques e opcionais</h3>
      <div class="flex items-center border rounded p-2">
        <div class="flex-grow flex gap-2">
          <div class="bg-gray-800 text-white rounded-full px-3 py-1 text-sm flex items-center">
            Multimídia
            <button class="ml-1 bg-green-500 rounded-full w-4 h-4 flex items-center justify-center text-xs">✓</button>
          </div>
          <div class="bg-gray-800 text-white rounded-full px-3 py-1 text-sm flex items-center">
            Rodas de liga leve
            <button class="ml-1 bg-green-500 rounded-full w-4 h-4 flex items-center justify-center text-xs">✓</button>
          </div>
          <div class="bg-gray-800 text-white rounded-full px-3 py-1 text-sm flex items-center">
            Câmbio DSG
            <button class="ml-1 bg-green-500 rounded-full w-4 h-4 flex items-center justify-center text-xs">✓</button>
          </div>
        </div>
        <div class="ml-2">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
          </svg>
        </div>
      </div>
    </div>

    <!-- Photos Section -->
    <div class="mb-8">
      <div class="flex justify-between items-center mb-4">
        <h3 class="text-lg text-gray-500 font-medium">Fotos</h3>
        <button class="bg-lime-400 hover:bg-lime-500 text-gray-900 px-4 py-1 rounded">Inserir</button>
      </div>

      <div class="relative">
        <!-- Photo Carousel -->
        <div class="flex overflow-x-auto space-x-2 pb-4">
          <div class="min-w-[200px] h-[120px] bg-gray-200 rounded">
            <img src="https://hebbkx1anhila5yf.public.blob.vercel-storage.com/carro%282%29-dohTu7eEVQ263dxEeCAgd5jr3O5kxo.png" alt="Volkswagen Golf branco - frente" class="w-full h-full object-cover rounded">
          </div>
          <div class="min-w-[200px] h-[120px] bg-gray-200 rounded relative">
            <img src="https://hebbkx1anhila5yf.public.blob.vercel-storage.com/carro%282%29-dohTu7eEVQ263dxEeCAgd5jr3O5kxo.png" alt="Volkswagen Golf - traseira" class="w-full h-full object-cover rounded brightness-50">
            <div class="absolute inset-0 flex justify-center items-center space-x-4">
              <button class="bg-lime-400 hover:bg-lime-500 p-2 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
              </button>
              <button class="bg-lime-400 hover:bg-lime-500 p-2 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
              </button>
            </div>
          </div>
          <div class="min-w-[200px] h-[120px] bg-gray-200 rounded">
            <img src="https://hebbkx1anhila5yf.public.blob.vercel-storage.com/carro%282%29-dohTu7eEVQ263dxEeCAgd5jr3O5kxo.png" alt="Volkswagen Golf branco - lateral" class="w-full h-full object-cover rounded">
          </div>
          <div class="min-w-[200px] h-[120px] bg-gray-200 rounded">
            <img src="https://hebbkx1anhila5yf.public.blob.vercel-storage.com/carro%282%29-dohTu7eEVQ263dxEeCAgd5jr3O5kxo.png" alt="Volkswagen Golf branco - detalhe" class="w-full h-full object-cover rounded">
          </div>
          <div class="min-w-[200px] h-[120px] bg-gray-200 rounded">
            <img src="https://hebbkx1anhila5yf.public.blob.vercel-storage.com/carro%282%29-dohTu7eEVQ263dxEeCAgd5jr3O5kxo.png" alt="Volkswagen Golf - interior" class="w-full h-full object-cover rounded">
          </div>
        </div>

        <!-- Navigation Arrows -->
        <button class="absolute left-0 top-1/2 transform -translate-y-1/2 bg-white bg-opacity-70 p-2 rounded-full shadow">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
          </svg>
        </button>
        <button class="absolute right-0 top-1/2 transform -translate-y-1/2 bg-white bg-opacity-70 p-2 rounded-full shadow">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
          </svg>
        </button>
      </div>
    </div>
  </div>
</template>

<script setup>
// Component logic would go here
// For a real implementation, you would add data properties, methods, etc.
</script>

<style>
/* Additional custom styles if needed */
</style>