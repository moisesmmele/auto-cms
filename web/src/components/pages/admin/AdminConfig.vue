<script>
import {useUserStore} from "../../../stores/useUserStore.js";

export default {
  name: "AdminConfig",
  data(){
    return {
      photos: [],
      previews: [],
      imagesIds: [],
    }
  },
  computed: {
    userStore: function () {
      return useUserStore()
    },
  },
  methods: {
    fileInputTrigger() {
      this.$refs.fileInput.click()
    },
    handleFileChange() {
      // Retrieve selected files
      const files = Array.from(this.$refs.fileInput.files);

      // Add each file to the photos array
      files.forEach(file => {
        this.photos.push(file);
      });

      // Log photos array to ensure multiple files are added
      console.log(this.photos);

      // Read each file for preview purposes
      files.forEach(file => {
        const reader = new FileReader();
        reader.onload = e => {
          this.previews.push(e.target.result);
        };
        reader.readAsDataURL(file);
      });

      // Clear the input value after processing to allow re-selection of same files
      this.$refs.fileInput.value = null;
      this.$emit("update:modelValue", this.photos);
    },

    removeImage(index) {
      this.photos.splice(index, 1)
      this.previews.splice(index, 1)
      this.$emit("update:modelValue", this.photos)
    },

    uploadImages() {
      console.log("Init method")
      const headers = new Headers()
      headers.append("Authorization", "Bearer " + this.userStore.user.token)
      const formData = new FormData()

      Array.from(this.photos).forEach(file => {
        formData.append(`${file.name}`, file);
      });

      const request = {
        method: 'POST',
        headers: headers,
        body: formData
      }

      console.log("init fetch")
      console.log("FormData: ", formData)
      fetch(`${import.meta.env.VITE_API_URL}/banners`, request)
          .then(res => res.json())
          .then(data => {
            data.forEach(item => {
              this.imagesIds.push(item.id)
            })
          })
    },
  }
}

</script>

<template>
  <div class="p-6">
    <h2>Inserir Banner</h2>
    <button @click="fileInputTrigger" class="bg-primary hover:bg-lime-500 text-secondary font-medium px-4 py-1 rounded">
      Inserir
    </button>
    <button @click="uploadImages" class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-4 py-1 rounded">
      Upload
    </button>
  </div>

  <input ref="fileInput" type="file" @change="handleFileChange" hidden>
  <div class="flex overflow-x-auto gap-2 pb-2">
    <div v-for="(image, index) in previews" :key="index" class="relative min-w-[150px] h-[100px] flex-shrink-0">
      <img :src="image" :alt="`Vehicle photo ${index + 1}`" class="w-full h-full object-cover" />
      <div class="absolute inset-0 bg-secondary bg-opacity-50 flex justify-center items-center gap-2 opacity-0 hover:opacity-100 transition-opacity">
        <button @click="removeImage(index)" class="bg-primary hover:bg-lime-500 w-8 h-8 rounded-full flex items-center justify-center">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
          </svg>
        </button>
      </div>
    </div>
  </div>
</template>

<style scoped>

</style>