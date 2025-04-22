<script>
export default {
  name: "banner",
  data() {
    return {
      images: [
        "../assets/banner-small.png"
      ],
      timer: null,
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
  <div class="relative">
    <transition-group name="fade" tag="div">
      <div v-for="i in [currentIndex]" :key="i" class="w-full">
        <img :src="currentImg" class="h-[600px] w-full object-cover" />
      </div>
    </transition-group>
    <a
        class="absolute left-0 top-2/5 cursor-pointer px-4 py-4 text-white font-bold text-lg transition-all duration-700 rounded-r-md select-none hover:bg-black hover:bg-opacity-90"
        @click="prev"
        href="#"
    >
      &#10094; Previous
    </a>
    <a
        class="absolute right-0 top-2/5 cursor-pointer px-4 py-4 text-white font-bold text-lg transition-all duration-700 rounded-l-md select-none hover:bg-black hover:bg-opacity-90"
        @click="next"
        href="#"
    >
      &#10095; Next
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