<template>
  <div class="fixed inset-0 backdrop-blur bg-opacity-50 flex items-center justify-center z-5" @click.self="closeModal">
    <div class="bg-white rounded-lg shadow-2xl w-full max-w-3xl relative">
      <!-- Header -->
      <div class="bg-teal-900 text-white px-6 py-4 flex justify-between items-center rounded-t-lg">
        <h2 class="text-lg font-semibold">Carro</h2>
        <button @click="closeModal" class="text-white hover:text-gray-300 text-2xl leading-none">
          &times;
        </button>
      </div>

      <!-- Body -->
      <div class="p-6">
        <slot>
          <!-- Default content -->
          <p>Conteúdo do modal aqui.</p>
        </slot>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Modal',
  emits: ['close'],
  methods: {
    closeModal() {
      this.$emit('close');
    }
  }
}
</script>
