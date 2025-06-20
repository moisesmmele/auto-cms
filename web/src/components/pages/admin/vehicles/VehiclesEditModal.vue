<script>
import notie from "notie/dist/notie.js";

export default {
  name: "GenericModal",
  props: {
    token: { type: String, required: true },
    user: {type: Object, required: true},
    resource: { type: String, required: true },
    type: { type: String, default: 'edit' },
  },
  data() {
    return {
      localUser: this.user
    }
  },
  watch: {
    user(newVal) {
      this.localUser = {...newVal}
    }
  },
  methods: {
    save() {
      const headers = new Headers()
      headers.append("Content-Type", "application/json")
      headers.append("Authorization", "Bearer " + this.token)

      let id = this.localUser.id
      let resource = this.resource
      const url = (this.type === 'edit')
          ? `${import.meta.env.VITE_API_URL}/${resource}/${id}`
          : `${import.meta.env.VITE_API_URL}/${resource}`;

      const method = (this.type === 'edit') ? "PUT" : "POST";

      let payload;

      if (this.localUser.password) {
        payload = {
          first_name: this.localUser.first_name,
          last_name: this.localUser.last_name,
          email: this.localUser.email,
          password: this.localUser.password
        }
      }
      if (!this.localUser.password) {
        payload = {
          first_name: this.localUser.first_name,
          last_name: this.localUser.last_name,
          email: this.localUser.email,
        }
      }

      const request = {
        method: method,
        headers: headers,
        body: JSON.stringify(payload)
      }
      fetch(url, request)
          .then(response => response.json()
              .then(data => ({ ok: response.ok, data })))
          .then(({ ok, data }) => {
            if (!ok) {
              notie.alert({
                type: "error",
                text: `Não foi possível atualizar usuário!`
              })
            } else {
              notie.alert({
                type: "success",
                text: `usuário criado(a)/atualizado(a) com sucesso!`
              })
              this.toggleModal()
            }
          })
    },
    toggle() {
      console.log('event fired')
      this.$emit('closeEditModal')
    }
  },
  mounted() {
    console.log("props dump: " + JSON.stringify(this.$props))
  }
}
</script>

<template>
  <Teleport to="body">
    <div class="fixed inset-0 flex items-center justify-center z-5">
      <div class="absolute inset-0 bg-black/30 backdrop-blur-sm" @click="toggle"></div>

      <div class="relative w-full max-w-2xl bg-white rounded-md shadow-lg overflow-hidden">
        <div class="bg-secondary text-white px-4 py-2.5 flex justify-between items-center">
          <h3 class="text-lg font-medium">Usuário</h3>
          <div class="flex space-x-1">
            <button @click="save" class="bg-primary hover:bg-green-400 p-1.5 rounded">
              <!-- save icon -->
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path d="M5 3h14a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2z"/>
                <path d="M9 3v5h6V3"/>
                <rect x="8" y="14" width="8" height="4" rx="1"/>
              </svg>
            </button>

            <button @click="toggle" class="bg-primary hover:bg-red-400 p-1.5 rounded">
              <!-- close icon -->
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <line x1="18" y1="6" x2="6" y2="18"/>
                <line x1="6" y1="6" x2="18" y2="18"/>
              </svg>
            </button>
          </div>
        </div>

        <!-- MODAL BODY -->
        <div class="p-6 flex flex-col gap-4 bg-gray-50">

          paragraph

        </div>
      </div>
    </div>
  </Teleport>
</template>

<style scoped>
/* optional scoped styles */
</style>
