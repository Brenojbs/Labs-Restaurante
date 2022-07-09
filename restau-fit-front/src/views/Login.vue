<template class="text-center">
  <div id="Login-api" class="text-center form-signin w-50 m-auto">

    <form >
      <h1 class="h3 mb-3 fw-normal text-center">Restau-fit!</h1>

      <b-form-input v-model="email" placeholder="Email"></b-form-input>
      <b-form-input type="password" v-model="password" placeholder="Senha"></b-form-input>
      <button class="w-100 btn btn-lg btn-primary" @click.stop.prevent="logado()">Logar</button>
      <div>
        <router-link class="m-1" to="cadastro">Cadastrar</router-link>
      </div>
    </form>

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
