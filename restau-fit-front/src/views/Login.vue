<template>
  <div id="Login-api">
    <div>
      <h1 class="mx-auto" style="width: 200px;">
      <p class="p">Restau-fit!</p>
      </h1>
      <b-form-input class="input mx-auto" v-model="email" placeholder="Email"></b-form-input>
      <b-form-input type="password" class="input mx-auto" v-model="senha" placeholder="Senha"></b-form-input>
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
      const senha = this.senha;
      const email = this.email;
      this.$axios.post('http://localhost:8000/login', {
        'senha': senha,
        'email': email,
      }).then((response)=>{

        // Aqui faz uma requisição para o back e ele retorna se é cliente ou admin.

        if(response.data == 'Cliente'){
            this.cliente = true
        }
        if(response.data == 'Admin'){
            this.admin = true
        }
        if(this.cliente){
          this.$emit("logado", 'Cliente')
        }
        if(this.admin){
          this.$emit("logado", 'Admin')
        }
      })
    }
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
