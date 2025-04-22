<script>

import {RouterView} from "vue-router";
import AppHeader from "./components/header/AppHeader.vue";
import AppFooter from "./components/footer/AppFooter.vue";

export default {
  components: {
    AppHeader,
    AppFooter,
    RouterView
  }
}

</script>

<template>
  <app-header/>
  <main>
    <router-view></router-view>
  </main>
  <app-footer/>
</template>

<style scoped>

</style>
