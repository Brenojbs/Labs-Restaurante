<template>
  <div id="Login-api">
    <div>
      <router-link class="m-1" to="cadastro">Cadastrar</router-link>
    </div>
    <div>
      <h1 class="mx-auto" style="width: 200px;">
      <p class="p">Restau-fit!</p>
      </h1>
      <b-form-input class="input m-2 mx-auto" v-model="email" placeholder="Email"></b-form-input>
      <b-form-input type="password" class="input m-2 mx-auto" v-model="password" placeholder="Senha"></b-form-input>
      <b-button variant="outline-primary" @click.stop.prevent="logado()">Logar</b-button>
    </div>
  </div>
</template>

<script>
import Cookie from 'js-cookie';

export default {
  name: 'Login-api',

  data: function() {
    return {
        email: "",
        password: "",
        cliente: false,
        admin: false,
      }
    },
  methods: {
    logado(){
      const password = this.password;
      const email = this.email;

      this.$axios.post('http://localhost:8000/login', {
        'password': password,
        'email': email,
      }).then((response)=>{
        // Aqui faz uma requisição para o back e ele retorna se é cliente ou admin.
        Cookie.set('token_back', response.data[0].original.access_token)
        if(response.data[1] == 'cliente'){
            this.cliente = true
        }
        if(response.data[1] == 'admin'){
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
