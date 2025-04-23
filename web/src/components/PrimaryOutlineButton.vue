<script>
import router from "../router/index.js";

export default {
  name: "PrimaryOutlineButton",
  props: {
    link: String,
    action: String,
    type: String,
    value: String,
  },
}
</script>

<template>
  <button class="border border-b-primary text-primary rounded-lg px-4 py-2 bg-transparent cursor-pointer hover:text-gray-100
  hover:border-b-gray-100 transition"
          :type>{{value}}</button>
</template>

<style scoped>

</style>