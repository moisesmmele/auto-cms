<script>

import {RouterView} from "vue-router";
import AppHeader from "./components/header/AppHeader.vue";
import AppFooter from "./components/footer/AppFooter.vue";
import security from "./security.js";
import {useUserStore} from "./stores/useUserStore.js";

export default {
  components: { AppHeader, AppFooter, RouterView },
  mounted() {
    const userStorage = useUserStore()
    userStorage.loadUserFromStorage()
  }
}

</script>

<template>
  <div class="flex flex-col min-h-screen">
  <app-header class="sticky top-0 z-10"/>
    <router-view class="flex-grow"/>
    <app-footer class="bottom-0 z-10"/>
  </div>
</template>

<style scoped>

</style>
