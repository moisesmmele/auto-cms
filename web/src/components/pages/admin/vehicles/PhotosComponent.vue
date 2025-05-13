<script>
export default {
  name: "PhotosComponent",
  data(){
    return {
      photos: [],
      previews: []
    }
  },
  methods: {
    fileInputTrigger() {
      this.$refs.fileInput.click()
    },
    handleFileChange() {
      const files = Array.from(this.$refs.fileInput.files);

      // Add new files to the images array
      this.photos.push(...files);

      // Preview the uploaded images
      files.forEach(photo => {
        const reader = new FileReader();
        reader.onload = e => {
          this.previews.push(e.target.result);
        };
        reader.readAsDataURL(photo);
      });
      this.$emit("update:modelValue", this.photos);
    },
    removeImage(index) {
      this.photos.splice(index, 1)
      this.previews.splice(index, 1)
      this.$emit("update:modelValue", this.photos)
    }
  }
}
</script>

<template>
  <div class="mt-8">
    <div class="flex justify-between items-center mb-4">
      <h2 class="text-xl text-gray-500 font-medium">Fotos</h2>
      <button @click="fileInputTrigger" class="bg-lime-400 hover:bg-lime-500 text-black font-medium px-4 py-1 rounded">
        Inserir
      </button>
      <input ref="fileInput" type="file" @change="handleFileChange" hidden>
    </div>

    <div class="relative">
      <div class="flex overflow-x-auto gap-2 pb-2">
        <div v-for="(image, index) in previews" :key="index" class="relative min-w-[150px] h-[100px] flex-shrink-0">
          <img :src="image" :alt="`Vehicle photo ${index + 1}`" class="w-full h-full object-cover" />
          <div class="absolute inset-0 bg-black bg-opacity-50 flex justify-center items-center gap-2 opacity-0 hover:opacity-100 transition-opacity">
            <button @click="removeImage(index)" class="bg-lime-400 hover:bg-lime-500 w-8 h-8 rounded-full flex items-center justify-center">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
              </svg>
            </button>
          </div>
        </div>
      </div>

      <!-- Navigation arrows -->
      <button class="absolute left-0 top-1/2 -translate-y-1/2 -ml-4 bg-white rounded-full shadow-md w-8 h-8 flex items-center justify-center">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
        </svg>
      </button>
      <button class="absolute right-0 top-1/2 -translate-y-1/2 -mr-4 bg-white rounded-full shadow-md w-8 h-8 flex items-center justify-center">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
        </svg>
      </button>
    </div>
  </div>
</template>

<style scoped>

</style>