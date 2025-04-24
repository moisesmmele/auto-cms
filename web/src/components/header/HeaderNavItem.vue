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
</template>

<style scoped>

</style>