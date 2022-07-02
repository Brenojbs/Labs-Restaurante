<template>
  <div>
    <router-view/>
    <div>
      <router-link class="m-1" to="/">Sair</router-link>
      <router-link class="m-1" to="cliente">Pratos</router-link>
    </div>

  <h1>Tela de Reserva</h1>
  <b-form-input class="input mx-auto" v-model="nome" placeholder="Nome"></b-form-input>
  <b-form-input class="input mx-auto" v-model="data" type="date" placeholder="Data"></b-form-input>
  <b-button variant="outline-primary" @click.stop.prevent="reservar()" >Reservar</b-button>

  <b-modal id="modal-1" title="Editar Reserva">
    <b-form-input class="input mx-auto" v-model="nome" placeholder="Nome"></b-form-input>
    <b-form-input class="input mx-auto" v-model="data" type="date" placeholder="Data"></b-form-input>
    <b-button v-b-modal.modal-1 @click="editar(index)" variant="primary">Salvar</b-button>
  </b-modal>

  <div>
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Nome</th>
          <th>Data</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(item, index) in items" :key="index">
          <th scope="row">{{ item.nome }}</th>
          <td>{{ item.data }}</td>
          <td>
            <b-button variant="primary" class="m-1" size="sm" v-b-modal.modal-1>Editar</b-button>
            <b-button variant="danger" class="m-1" size="sm" @click="deletar(index)">Deletar</b-button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
</template>

<script>
export default {
  name: 'Reserva-Cliente',
  data: function() {
    return {
        mensagem: "",
        nome: "",
        data: "",
        items: [],
          fields: [
            {
              key: 'nome',
              label: 'Nome',
              sortable: true,
            },
            {
              key: 'data',
              label: 'Data',
              sortable: true,
            },
            {
              key: 'actions',
              label: 'Ações',
            },
          ]
      }
    },
  methods: {
    reservar(){
      this.items.push({nome: this.nome, data: this.data})
      console.log(this.nome, this.data)
      this.nome = ""
      this.data = ""
    },
    editar(id){
    // this.$axios.put(''+id).then((response)=>{
    //   this.items = response.data
    // })
    // .catch((error)=>{
    //   console.log(error)
    // })
      this.items.splice(id, 1, {nome: this.nome, data: this.data})
      this.nome = ""
      this.data = ""
    },
    deletar(id){
    // this.$axios.delete(''+id).then((response)=>{
    //   this.mensagem = response.data
    // })
    // .catch((error)=>{
    //   console.log(error)
    // })
      this.items.splice(id, 1)
    }
  },
  created(){
  //   this.$axios.get('').then((response)=>{
  //     this.items = response.data.results
  //   })
  //   .catch((error)=>{
  //     console.log(error)
  //   })
    // this.$router.push({path: '/reserva'})
  },
  components: {},
}
</script>
