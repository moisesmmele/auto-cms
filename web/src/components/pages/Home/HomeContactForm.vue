<script>
export default {
  name: "HomeContactForm"
}
</script>

<template>
  <div class="max-w-6xl mx-auto px-4 py-12">
    <h1 class="text-4xl font-bold text-center text-gray-800">Entrar em contato</h1>
    <p class="text-center text-gray-600 mt-2 mb-10">
      Entre em contato através dos nossos canais oficiais ou solicite contato através do formulário
    </p>

    <div class="bg-white rounded-lg shadow-lg overflow-hidden flex flex-col md:flex-row">
      <!-- Left side - Contact channels -->
      <div class="bg-[#052e36] text-white p-8 md:w-1/3">
        <h2 class="text-3xl font-bold mb-4">Nossos Canais</h2>
        <p class="mb-8">
          Entre em contato através dos nossos canais oficiais ou solicite contato através do formulário
        </p>

        <div class="space-y-6">
          <div class="flex items-center">
            <div class="w-6 mr-4">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
              </svg>
            </div>
            <span>(24) 9999-9999</span>
          </div>

          <div class="flex items-center">
            <div class="w-6 mr-4">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
              </svg>
            </div>
            <span>contato@email.com</span>
          </div>

          <div class="flex items-start">
            <div class="w-6 mr-4 mt-1">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
              </svg>
            </div>
            <div>
              <p>Rua dos Bobos, 4 - Hollywood</p>
              <p>Los Angeles, CA - 12312312</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Right side - Contact form -->
      <div class="p-8 md:w-2/3">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div>
            <label class="block text-gray-700 mb-2">Nome</label>
            <input type="text" class="w-full border-b border-gray-300 focus:border-gray-500 outline-none py-2" />
          </div>

          <div>
            <label class="block text-gray-700 mb-2">Email</label>
            <input type="email" class="w-full border-b border-gray-300 focus:border-gray-500 outline-none py-2" />
          </div>

          <div>
            <label class="block text-gray-700 mb-2">Telefone</label>
            <input type="tel" class="w-full border-b border-gray-300 focus:border-gray-500 outline-none py-2" />
          </div>

          <div>
            <label class="block text-gray-700 mb-2">CPF</label>
            <input type="text" class="w-full border-b border-gray-300 focus:border-gray-500 outline-none py-2" />
          </div>
        </div>

        <div class="mt-8">
          <p class="text-gray-700 mb-4">Estou interessado em:</p>
          <div class="flex flex-wrap gap-6">
            <label class="flex items-center">
              <input type="radio" name="interest" value="comprar" class="mr-2 h-5 w-5" />
              <span>Comprar</span>
            </label>

            <label class="flex items-center">
              <input type="radio" name="interest" value="vender" class="mr-2 h-5 w-5" />
              <span>Vender</span>
            </label>

            <label class="flex items-center">
              <input type="radio" name="interest" value="trocar" class="mr-2 h-5 w-5" checked />
              <span>Trocar</span>
            </label>

            <label class="flex items-center">
              <input type="radio" name="interest" value="financiar" class="mr-2 h-5 w-5" />
              <span>Financiar</span>
            </label>
          </div>
        </div>

        <div class="mt-8">
          <label class="block text-gray-700 mb-2">Mensagem</label>
          <textarea rows="4" class="w-full border-b border-gray-300 focus:border-gray-500 outline-none py-2"></textarea>
        </div>

        <div class="mt-8">
          <button class="w-full bg-[#b0f000] hover:bg-[#9ed600] text-black font-bold py-4 rounded transition duration-200">
            Enviar mensagem
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>

</style>