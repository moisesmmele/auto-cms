<script>
export default {
  name: "banner",
  beforeMount() {
    fetch('http://localhost:8083/images')
        .then(response => response.json()) // you need to call json()
        .then((response) => {
          console.log(response);
          for (let image of response) {
            this.images.push({id: image.id, url:image.url, height:image.height, length:image.lenght});
          }
        })
        .catch(error => console.error('Error fetching images:', error));
    console.log(this.images)
  },
  data() {
    return {
      images: [],
      timer: 30,
      currentIndex: 0
    };
  },
  mounted: function() {
    this.startSlide();
  },
  methods: {
    startSlide: function() {
      this.timer = setInterval(this.next, 4000);
    },
    next: function() {
      this.currentIndex += 1;
    },
    prev: function() {
      this.currentIndex -= 1;
    }
  },
  computed: {
    currentImg: function() {
      return this.images[Math.abs(this.currentIndex) % this.images.length];
    }
  }
}
</script>

<template>
    <div class="relative w-full h-[500px] overflow-hidden">
      <transition-group name="fade" tag="div">
        <div v-for="i in [currentIndex]" :key="i" class="w-full h-full">
          <img
              v-if="currentImg"
              :src="currentImg.url"
              :style="{ height: currentImg.height + 'px' }"
              class="w-full object-cover transition-opacity duration-1000 ease-in-out"
          />
        </div>
      </transition-group>
      <a
          class="absolute left-0 top-2/5 cursor-pointer px-4 py-4 text-white font-bold text-lg transition-all duration-700 rounded-r-md select-none hover:bg-black hover:bg-opacity-90"
          @click="prev"
          href="#"
      >
        &#10094;
      </a>
      <a
          class="absolute right-0 top-2/5 cursor-pointer px-4 py-4 text-white font-bold text-lg transition-all duration-700 rounded-l-md select-none hover:bg-black hover:bg-opacity-90"
          @click="next"
          href="#"
      >
        &#10095;
      </a>
    </div>
</template>

<style>
.fade-enter-active,
.fade-leave-active {
  transition: all 0.9s ease;
  overflow: hidden;
  visibility: visible;
  position: absolute;
  width: 100%;
  opacity: 1;
}

.fade-enter,
.fade-leave-to {
  visibility: hidden;
  width: 100%;
  opacity: 0;
}
</style>