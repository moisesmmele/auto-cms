<script>
import {useUserStore} from "../../stores/useUserStore.js";
import Router from "../../router/index.js";

export default {
  computed: {
    userStore: function () {
      return useUserStore()
    }
  }
}

</script>

<template>
  <footer v-if="isAdminPage" class="bg-secondary text-white p-4 text-center">
    <div class="container mx-auto sticky">
      Todos os direitos reservados | Auto CMS
    </div>
  </footer>
  <footer v-else class="bg-secondary text-white py-8">
    <div class="container mx-auto px-4">
      <!-- Main footer content -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Site Map -->
        <div>
          <h2 class="text-xl font-semibold mb-4">Mapa do Site</h2>
          <nav class="flex flex-col space-y-2">
            <a href="#" class="hover:underline">Início</a>
            <a href="#" class="hover:underline">Estoque</a>
            <a href="#" class="hover:underline">Contato</a>
            <a href="#" class="hover:underline">Sobre</a>
            <a href="#" class="hover:underline">Políticas e Privacidade</a>
          </nav>
        </div>

        <!-- Legal Notice -->
        <div>
          <p class="text-sm">
            AVISO LEGAL // As informações apresentadas neste site são fornecidas apenas para fins informativos e podem não
            refletir com precisão a disponibilidade, preços, condições de compra e venda ou especificações dos veículos. A
            agência não se responsabiliza por quaisquer erros, imprecisões ou omissões que possam ocorrer.
          </p>
        </div>
      </div>

      <!-- Divider -->
      <div class="border-t border-gray-700 my-6"></div>

      <!-- Logo and Company Info -->
      <div class="flex flex-col md:flex-row justify-between items-center">
        <div class="flex items-center mb-4 md:mb-0">
          <div class="mr-2">
            <!-- Car icon SVG -->
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="24" viewBox="0 0 24 24" class="text-green-400 fill-current">
              <path d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5h-11c-.66 0-1.21.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99zM6.5 16c-.83 0-1.5-.67-1.5-1.5S5.67 13 6.5 13s1.5.67 1.5 1.5S7.33 16 6.5 16zm11 0c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zM5 11l1.5-4.5h11L19 11H5z" />
            </svg>
          </div>
          <span class="text-2xl font-bold">AutoCMS</span>
        </div>

        <div class="text-right text-sm">
          <p>EMPRESA COMERCIO DE VEICULOS LTDA - 12.345.678/0001-01</p>
          <p>Rua Quatro, 208 - Resende, RJ - 27516-388</p>
        </div>
      </div>

      <!-- Divider -->
      <div class="border-t border-gray-700 my-6"></div>

      <!-- Copyright -->
      <div class="text-center text-sm">
        <p>
          Todos os direitos reservados | Transforma Auto | Desenvolvido por
          <span class="font-semibold">Transforma Digital</span>
        </p>
      </div>
    </div>
  </footer>
</template>

<style scoped>

</style>