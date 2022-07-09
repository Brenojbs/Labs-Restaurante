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
          </b-card>
        </div>
      </div>
	</div>
</template>

<script>
import Cookie from 'js-cookie';

export default {
	name: 'Tela-Cliente',
	data: function() {
    return {
        access_token: null,
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
  created(){
    this.access_token = Cookie.get('token_back')

    this.$axios.get('http://localhost:8000/cliente/prato',{
      headers: {
        'Authorization': `Bearer ${this.access_token}`
      }
    }).then((response)=>{
      this.items = response.data
    })
  },
  watch: {
    filtro() {
      if(this.filtro) {
        this.$axios.get('http://localhost:8000/cliente/prato/' + this.filtro,{
      headers: {
        'Authorization': `Bearer ${this.access_token}`
      }}).then((response) => {
          this.items2 = response.data
        })
      }else {
        this.items2 = null;
      }
    },
    // items() {
    //       this.$axios.get('http://localhost:8000/admin/prato').then((response) => {
    //         this.items = response.data
    //         console.log(this.items)
    //       })
    // }
  }
}
</script>