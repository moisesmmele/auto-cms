<script>
import {RouterLink} from "vue-router";

export default {
  name: "HeaderNavItem",
  props: {
    link: String,
    value:String,
  },
  mounted() {
    console.log(this.link, this.value)
  },
  components: {
    RouterLink
  }
}
</script>

<template>
  <RouterLink :to=this.link class="text-gray-100 hover:font-medium transition delay-300">{{this.value}}</RouterLink>
</template>

<style scoped>

</style>