<template class="text-center">
  <div id="Cadastro-api" class="text-center form-signin w-50 m-auto">
    <form>
      <h1 class="h3 mb-3 fw-normal text-center">
        Restau-fit!
      </h1>
      <b-form-input v-model="nome" placeholder="Nome"></b-form-input>
      <b-form-input v-model="email" placeholder="Email"></b-form-input>
      <b-form-input type="password" v-model="password" placeholder="Senha"></b-form-input>
      <button class="w-100 btn btn-lg btn-primary" @click.stop.prevent="cadastrar()">Cadastrar</button>
      <div>
        <router-link class="m-1" to="/">Login</router-link>
      </div>
    </form>
    <div v-if="mensagem">
      {{ mensagem }}
    </div>
  </div>
</template>

<script>
import router from '../router'

export default {
  name: 'Cadastro-api',

  data: function() {
    return {
        mensagem: null,
        nome: "",
        email: "",
        password: "",
        categoria: 'cliente',
      }
    },
  methods: {
    cadastrar(){
      const password = this.password;
      const email = this.email;
      const nome = this.nome;
      const categoria = this.categoria;

      this.$axios.post('http://localhost:8000/cadastro', {
            nome,
            password,
            email,
            categoria,
        }).then((response) => {
          if (typeof(response.data[1]) == 'string') {
            this.mensagem = response.data[1]
          }
          this.nome = "";
          this.email = "";
          this.password = "";
          router.push({name: 'Login'})
        })
          .catch((error) => {
            console.log(error)
        })
    }
  }
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
