<script setup>
import HeaderNavItem from "./HeaderNavItem.vue";
import PrimaryOutlineButton from "../PrimaryOutlineButton.vue";

</script>

<template>
  <header class="bg-secondary shadow-md top-0 left-0 w-full z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between items-center h-20">
        <div class="flex-shrink-0 h-full">
          <router-link to="/">
            <img src="../../assets/logo.png" class="w-full h-full object-contain">
          </router-link>
        </div>
        <nav class="flex items-center space-x-8">
          <HeaderNavItem link="/estoque" value="Estoque"/>
          <HeaderNavItem link="/sobre" value="Sobre"/>
          <HeaderNavItem link="/contato" value="Contato"/>
          <PrimaryOutlineButton link="/admin/login" value="Login"/>
        </nav>
      </div>
    </div>
  </header>

</template>

<style scoped>

</style>