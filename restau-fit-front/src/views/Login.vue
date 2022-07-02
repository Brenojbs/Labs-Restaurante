<template>
  <div id="Login-api">
    <div>
      <h1 class="mx-auto" style="width: 200px;">
      <p class="p">Tela de Login!</p>
      </h1>
      <b-form-input class="input mx-auto" v-model="email" placeholder="Email"></b-form-input>
      <b-form-input class="input mx-auto" v-model="senha" placeholder="Senha"></b-form-input>
      <b-button variant="outline-primary" @click.stop.prevent="logado()">Button</b-button>
    </div>

  </div>
</template>

<script>

export default {
  name: 'Login-api',

  data: function() {
    return {
        email: "",
        senha: "",
        cliente: false,
        admin: false,
      }
    },
  methods: {
    logado(){
      this.$axios.get('').then(()=>{
        // Aqui faz uma requisição para o back e ele retorna se é cliente ou admin.
        // if(response.data == 'cliente'){
        //    this.cliente = true
        // }
        // if(response.data == 'admin'){
        //    this.admin = true
        // }
      })
      if(this.cliente){
        this.$emit("logado", 'cliente')
      }
      if(this.admin){
        this.$emit("logado", 'admin')
      }
    },
  },

}
</script>

<style scoped>
  .p {
    width: 200%;
  }
  .input {
    width: 50%;
  }
</style>
