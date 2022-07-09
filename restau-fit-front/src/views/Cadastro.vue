<template>
  <div id="Cadastro-api">
    <div>
    <div>
      <router-link class="m-1" to="/">Login</router-link>
    </div>
      <h1 class="mx-auto" style="width: 200px;">
      <p class="p">Restau-fit!</p>
      </h1>
      <b-form-input class="input m-2 mx-auto" v-model="nome" placeholder="Nome"></b-form-input>
      <b-form-input class="input m-2 mx-auto" v-model="email" placeholder="Email"></b-form-input>
      <b-form-input type="password" class="input m-2 mx-auto" v-model="password" placeholder="Senha"></b-form-input>
      <b-button variant="outline-primary" @click.stop.prevent="cadastrar()">Cadastrar</b-button>
    </div>
    <div v-if="mensagem">
      {{ mensagem }}
    </div>
  </div>
</template>

<script>

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
          this.items.push({
            nome: this.nome,
            email: this.email,
            password: this.password,
            categoria: this.categoria,
        })
          if (response.data == 'Email existente!') {
            this.mensagem = 'Email existente!'
          }
          this.nome = "";
          this.email = "";
          this.password = "";
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
