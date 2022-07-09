<template id='Tela-Admin'>
  <div>
    <div>
      <router-link class="m-1" to="/">Sair</router-link>
    </div>
    <h1 class="mx-auto" style="width: 200px;">
      <p class="p">Cadastrar Pratos!</p>
    </h1>
    <div>
      <div>
        <b-form-input class="input mx-auto" v-model="nome" placeholder="Nome"></b-form-input>
        <b-form-select v-model="categoria" :options="options" size="sm" class="mt-3"></b-form-select>
        <b-form-input class="input mx-auto" v-model="preço" type="number" placeholder="Preço"></b-form-input>
        <b-form-input class="input mx-auto" v-model="imagem" placeholder="Imagem"></b-form-input>
        <b-button variant="outline-primary" @click.stop.prevent="cadastrar()">Cadastrar</b-button>
      </div>
      <div>
        <b-form-select v-model="filtro" :options="options" size="sm" class="mt-3"></b-form-select>
        <div class="mt-3">Filtro: <strong>{{ filtro }}</strong></div>
      </div>
      <div v-if="!items2">
        <div  v-for="(item) in items" :key="item.id">
          <b-card title='Pratos lindos' :src="`${item.imagem}`" img-alt="Image de carne na panela" img-top tag="article"
            style="max-width: 20rem;" class="mb-2">
            <b-card-text>
              {{ item.nome }}
            </b-card-text>
            <b-card-text>
              {{ item.categoria }}
            </b-card-text>
            <b-card-text>
              R$ {{ item.preço }},00
            </b-card-text>
            <b-button variant="primary" class="m-1" size="sm" @click="modal(item.id)" v-b-modal.modal-1>Editar</b-button>
            <b-button variant="danger" class="m-1" size="sm" @click="deletar(item.id)">Deletar</b-button>
          </b-card>
        </div>
      </div>
      <div v-else>
        <div  v-for="(item) in items2" :key="item.id">
          <b-card title='Pratos lindos' :src="`${item.imagem}`" img-alt="Image de carne na panela" img-top tag="article"
            style="max-width: 20rem;" class="mb-2">
            <b-card-text>
              {{ item.nome }}
            </b-card-text>
            <b-card-text>
              {{ item.categoria }}
            </b-card-text>
            <b-card-text>
              R$ {{ item.preço }},00
            </b-card-text>
            <b-button variant="primary" class="m-1" size="sm" @click="modal(item.id)" v-b-modal.modal-1>Editar</b-button>
            <b-button variant="danger" class="m-1" size="sm" @click="deletar(item.id)">Deletar</b-button>
          </b-card>
        </div>
      </div>
      <div>
        <b-modal id="modal-1" title="Editar Prato">
          <b-form-input class="input mx-auto" v-model="nome" placeholder="Nome"></b-form-input>
          <b-form-select v-model="categoria" :options="options" size="sm" class="mt-3"></b-form-select>
          <b-form-input class="input mx-auto" v-model="preço" type="number" placeholder="Preço"></b-form-input>
          <b-form-input class="input mx-auto" v-model="imagem" placeholder="Imagem"></b-form-input>
          <b-button v-b-modal.modal-1 @click="editar(id)" variant="primary">Salvar</b-button>
        </b-modal>
      </div>
    </div>
  </div>
</template>

<script>
import Cookie from 'js-cookie';

export default {
  name: 'Tela-Admin',
  data() {
    return {
      access_token: null,
      nome: '',
      categoria: null,
      imagem: '',
      preço: 0,
      id: "",
      filtro: null,
      items: [],
      items2: null,
      options: [
        { value: null, text: 'Selecione uma categoria' },
        { value: 'Cozido', text: 'Cozido' },
        { value: 'Assado', text: 'Assado' },
        { value: 'Frito', text: 'Frito' }
      ],

      fields: [
        {
          key: 'nome',
          label: 'Nome',
          sortable: true,
        },
        {
          key: 'imagem',
          label: 'Imagem',
        },
        {
          key: 'categoria',
          label: 'Categoria',
        },
        {
          key: 'preço',
          label: 'Preço',
          sortable: true,
        }
      ]
    }
  },
  methods: {
    cadastrar() {
      const nome = this.nome;
      const categoria = this.categoria;
      const imagem = this.imagem;
      const preço = this.preço;

      this.$axios.post('http://localhost:8000/admin/prato/', {
        nome,
        categoria,
        imagem,
        preço,
      },{
      headers: {
        'Authorization': `Bearer ${this.access_token}`
      }
    }).then(() => {
        this.items.push({
          nome: this.nome,
          categoria: this.categoria,
          imagem: this.imagem,
          preço: this.preço,
        })

        this.nome = "";
        this.categoria = "";
        this.imagem = "";
        this.preço = "";
      })
        .catch((error) => {
          console.log(error)
        })
    },
    get(){
      this.$axios.get('http://localhost:8000/admin/prato',{
      headers: {
        'Authorization': `Bearer ${this.access_token}`
      }
    }).then((response)=>{
        this.items = response.data
      })
    },
    modal(id) {
      this.id = id;
    },
    editar(id) {
      this.$axios.put('http://localhost:8000/admin/prato/' + id, {
          nome: this.nome,
          categoria: this.categoria,
          imagem: this.imagem,
          preço: this.preço,
        },{
      headers: {
        'Authorization': `Bearer ${this.access_token}`
      }
    }).then(() => {

        this.nome = "";
        this.categoria = "";
        this.imagem = "";
        this.preço = "";
        this.id = "";
        this.get();
      })
        .catch((error) => {
          console.log(error)
        })
    },
    deletar(id) {
      this.$axios.delete('http://localhost:8000/admin/prato/' + id,{
      headers: {
        'Authorization': `Bearer ${this.access_token}`
      }
    }).then(()=>{
        this.get();
      })
      .catch((error)=>{
        console.log(error)
      })
    }
  },
  created() {
    this.access_token = Cookie.get('token_back')

    this.$axios.get('http://localhost:8000/admin/prato',{
      headers: {
        'Authorization': `Bearer ${this.access_token}`
      }
    }).then((response) => {
      this.items = response.data
    })
  },
  watch: {
    filtro() {
      if(!this.filtro) {
        this.items2 = null;
      }else {
        this.$axios.get('http://localhost:8000/cliente/prato/' + this.filtro,{
          headers: {
            'Authorization': `Bearer ${this.access_token}`
          }}).then((response) => {
                  this.items2 = response.data 
                })
      }
    },
    // items() {
    //       this.$axios.get('http://localhost:8000/admin/prato').then((response) => {
    //         this.items = response.data
    //       })
    // }
  }
}
</script>