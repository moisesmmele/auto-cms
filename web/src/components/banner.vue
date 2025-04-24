<script>
export default {
  name: "Banner",
  props: {
    images: {
      type: Array,
      required: true
    }
  },
  data() {
    return {
      timer: null,
      currentIndex: 0
    };
  },
  mounted() {
    this.startSlide();
  },
  beforeDestroy() {
    clearInterval(this.timer);
  },
  methods: {
    startSlide() {
      this.timer = setInterval(this.next, 4000);
    },
    next() {
      this.currentIndex = (this.currentIndex + 1) % this.images.length;
    },
    prev() {
      this.currentIndex =
          (this.currentIndex - 1 + this.images.length) % this.images.length;
    }
  },
  computed: {
    currentImg() {
      if (!this.images || !this.images.length) return null;

      const image = this.images[this.currentIndex];
      const baseUrl = "http://localhost:8083";
      return {
        ...image,
        url: baseUrl + image.url
      };
    }
  }
};
</script>

<template>
  <div class="relative w-full h-[500px] overflow-hidden">
    <transition name="fade">
      <div :key="currentIndex" class="w-full h-full">
        <img
            v-if="currentImg"
            :src="currentImg.url"
            :style="{ height: currentImg.height + 'px' }"
            class="w-full object-cover transition-opacity duration-1000 ease-in-out"
        />
      </div>
    </transition>

    <a
        class="absolute left-0 top-2/5 cursor-pointer px-4 py-4 text-white font-bold text-lg transition-all duration-700 rounded-r-md select-none hover:bg-black hover:bg-opacity-90"
        @click.prevent="prev"
        href="#"
    >
      &#10094;
    </a>
    <a
        class="absolute right-0 top-2/5 cursor-pointer px-4 py-4 text-white font-bold text-lg transition-all duration-700 rounded-l-md select-none hover:bg-black hover:bg-opacity-90"
        @click.prevent="next"
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
  position: absolute;
  width: 100%;
  opacity: 1;
}

.fade-enter,
.fade-leave-to {
  opacity: 0;
}
</style>
