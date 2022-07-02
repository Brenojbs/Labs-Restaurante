<template id='Tela-Cliente'>
  <div>
    <div>
      <router-link class="m-1" to="/">Sair</router-link>
      <router-link class="m-1" to="reserva">Reserva</router-link>
    </div>
    <h1 class="mx-auto" style="width: 200px;">
      <p class="p">Tela de Pratos!</p>
    </h1>
    <div>
      <b-form-select v-model="filtro" :options="options" size="sm" class="mt-3"></b-form-select>
      <div class="mt-3">Filtro: <strong>{{ filtro }}</strong></div>
    </div>

    <div v-for="(item, index) in items" :key="index">
      <b-card
        title=item.nome
        img-src=${item.imagem}
        img-alt="Image de carne na panela"
        img-top
        tag="article"
        style="max-width: 20rem;"
        class="mb-2"
      >
        <b-card-text>
          {{item.nome}}
        </b-card-text>
        <b-card-text>
          {{item.categoria}}
        </b-card-text>
        <b-card-text>
          {{item.preço}}
        </b-card-text>
      </b-card>
    </div>
	</div>
</template>

<script>

export default {
	name: 'Tela-Cliente',
	data: function() {
    return {
        mensagem: "",
        nome: "",
        data: "",
        filtro: null,
        options: [
          { value: null, text: 'Selecione uma categoria' },
          { value: 'Cosido', text: 'Cosido' },
          { value: 'Assado', text: 'Assado' },
          { value: 'Frito', text: 'Frito' }
        ],
        items: [
              {
              nome: 'Carne de Panela',
              imagem: 'https://149777215.v2.pressablecdn.com/wp-content/uploads/2018/01/shutterstock_162331454.jpg',
              categoria: 'Cosido',
              preço: 'R$ 0,00'
            } 
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
    // reservar(){
    //   this.items.push({nome: this.nome, data: this.data})
    //   console.log(this.nome, this.data)
    //   this.nome = ""
    //   this.data = ""
    // },
  },
  created(){
    // this.$axios.get('').then((response)=>{
    //   this.items = response.data.results
    // })
    // .catch((error)=>{
    //   console.log(error)
    // })
  },
  // watch: {
  //   filtro() {
  //     this.$axios.get('' + this.filtro).then(() => {
  //       this.items = response.data 
  //     })
  //   }
  // }
}
</script>