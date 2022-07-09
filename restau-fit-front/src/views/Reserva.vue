<template>
  <div class="h3 mb-3 fw-normal text-center">
    <router-view/>
    <div>
      <router-link class="m-1" to="/">Sair</router-link>
      <router-link class="m-1" to="cliente">Pratos</router-link>
    </div>

  <h1 class="h3 m-3 fw-normal text-center">Tela de Reserva</h1>
  <b-form-input class="m-1" v-model="nome" placeholder="Nome"></b-form-input>
  <b-form-input class="m-1" v-model="data" type="date" placeholder="Data"></b-form-input>
  <button class="w-20 m-1 btn btn-lg btn-primary" @click.stop.prevent="reservar()" >Reservar</button>

  <b-modal id="modal-1" title="Editar Reserva">
    <b-form-input class="input mx-auto" v-model="nome" placeholder="Nome"></b-form-input>
    <label for="example-datepicker">Choose a date</label>
    <b-form-datepicker id="example-datepicker" v-model="data" class="mb-2"></b-form-datepicker>
    <b-button v-b-modal.modal-1 @click="editar(id)" variant="primary">Salvar</b-button>
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
        <tr v-for="(item) in items" :key="item.id">
          <th scope="row">{{ item.nome }}</th>
          <td>{{ item.data }}</td>
          <td>
            <b-button variant="primary" class="m-1" size="sm" @click="modal(item.id)" v-b-modal.modal-1>Editar</b-button>
            <b-button variant="danger" class="m-1" size="sm" @click="deletar(item.id)">Deletar</b-button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
</template>

<script>
import Cookie from 'js-cookie';

export default {
  name: 'Reserva-Cliente',
  data: function() {
    return {
        access_token: null,
        nome: "",
        data: "",
        id: "",
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
      const nome = this.nome;
      const data = this.data;

      this.$axios.post('http://localhost:8000/cliente/reserva', {
          nome,
          data,
        },{
        headers: {
          'Authorization': `Bearer ${this.access_token}`
        }
      }).then(() => {
        this.items.push({
          nome: this.nome,
          data: this.data,
        })

        this.nome = "";
        this.data = "";
      })
        .catch((error) => {
          console.log(error)
        })
    },
    get(){
      this.$axios.get('http://localhost:8000/cliente/reserva',{
      headers: {
        'Authorization': `Bearer ${this.access_token}`
      }
    }).then((response)=>{
        this.items = response.data
      })
    },
    editar(id){
      this.$axios.put('http://localhost:8000/cliente/reserva/' + id, {
          nome: this.nome,
          data: this.data,
        },{
      headers: {
        'Authorization': `Bearer ${this.access_token}`
      }
    }).then(() => {

        this.nome = "";
        this.data = "";
        this.id = "";
        this.get();
      })
        .catch((error) => {
          console.log(error)
        })
    },
    deletar(id){
      this.$axios.delete('http://localhost:8000/cliente/reserva/' + id,{
      headers: {
        'Authorization': `Bearer ${this.access_token}`
      }
    }).then(()=>{
        this.items.splice(id, 1)
        this.get();
      })
      .catch((error)=>{
        console.log(error)
      })
    },
    modal(id){
      this.id = id
    }
  },
  created(){
    this.access_token = Cookie.get('token_back')

    this.$axios.get('http://localhost:8000/cliente/reserva',{
      headers: {
        'Authorization': `Bearer ${this.access_token}`
      }
    }).then((response)=>{
      this.items = response.data
    })
  },
}
</script>
