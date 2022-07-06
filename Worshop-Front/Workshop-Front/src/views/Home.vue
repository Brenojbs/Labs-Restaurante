<template>
  <div class="home">
    <div>
      <b-button
        variant="primary"
        style="float: right"
        @click="$bvModal.show('bv-modal-car'), (edit_car = null)"
        size="sm"
        class="mr-1"
      >
        Novo Carro
      </b-button>
    </div>
    <b-table
      :items="items"
      :sort-by.sync="sortBy"
      :sort-desc.sync="sortDesc"
      sort-icon-left
      responsive="sm"
    >
      <template #cell(actions)="row">
        <b-button
          @click="deletar(row.item.id)"
          variant="danger"
          size="sm"
          class="space-btn pointer"
        >
          Deletar
        </b-button>
        <b-button
          @click="buscar(row.item.id)"
          size="sm"
          class="space-btn pointer"
        >
          Detalhes
        </b-button>
        <b-button
          @click="edit(row.item.id)"
          size="sm"
          variant="success"
          class="space-btn pointer"
        >
          Editar
        </b-button>
      </template>
    </b-table>
    <div class="text-center" v-if="loading">
  <b-spinner></b-spinner>
    </div>
    <b-modal id="bv-modal-car" hide-footer>
      <template #modal-title>{{
        edit_car ? "Editar Carro" : "Novo Carro"
      }}</template>
      <div class="d-block text-center">
        <b-form-group label="Nome do carro">
          <b-form-input v-model="nome" placeholder="Ex: Fusca"></b-form-input>
        </b-form-group>
      </div>
      <div class="d-block text-center">
        <b-form-group label="Marca do carro">
          <b-form-input v-model="marca" placeholder="Ex: Wv"></b-form-input>
        </b-form-group>
      </div>
      <div class="d-block text-center">
        <b-form-group label="Cor do carro">
          <b-form-input v-model="cor" placeholder="Ex: Azul"></b-form-input>
        </b-form-group>
      </div>
      <div class="d-block text-center">
        <b-form-group label="KM do carro">
          <b-form-input v-model="km" placeholder="Ex: 40000"></b-form-input>
        </b-form-group>
      </div>
      <div class="d-block text-center">
        <b-form-group label="Imagem do carro">
          <b-form-input
            v-model="image"
            placeholder="Url da Imagem"
          ></b-form-input>
        </b-form-group>
      </div>
      <div class="d-block text-center">
        <b-form-group label="Detalhes do carro">
          <b-form-textarea
            id="textarea"
            v-model="detail"
            placeholder="Detalhes do carro..."
            rows="3"
            max-rows="6"
          ></b-form-textarea>
        </b-form-group>
      </div>
      <b-button class="mt-3" block @click="$bvModal.hide('bv-modal-car')"
        >Fechar</b-button
      >
      <b-button
        v-if="!edit_car"
        style="float: right"
        class="mt-3"
        block
        variant="primary"
        @click="cadastrar()"
        >Cadastrar Carro</b-button
      >
      <b-button v-else style="float: right" variant="primary" class="mt-3" block @click="editar()"
        >Atualizar Carro</b-button
      >
    </b-modal>
    <b-modal id="bv-modal-uniq-car" title="Detalhes do Carro" hide-footer>
      <b-img :src="uniq_car.image" fluid alt="image" class="mb-3"></b-img>
      <p>Nome: {{ uniq_car.name }}</p>
      <p>Marca: {{ uniq_car.brand }}</p>
      <p>Cor: {{ uniq_car.color }}</p>
      <p>KM: {{ uniq_car.km }}</p>
      <p>Detalhes: {{ uniq_car.detail }}</p>
      <!-- {{ uniq_car }} -->
    </b-modal>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "Home",
  data() {
    return {
      carros: [],
      sortBy: "age",
      sortDesc: false,
      items: [],
      image: "",
      cor: "",
      km: null,
      marca: "",
      nome: "",
      loading: false,
      detail: "",
      uniq_car: {},
      edit_car: null,
    };
  },
  methods: {
    edit(id) {
      this.edit_car = id;
      var that = this;
      axios
        .get("http://workshop.innovaweb.com.br/cars/" + id)
        .then(function (response) {
          console.log(response);
          that.nome = response.data.name;
          that.marca = response.data.brand;
          that.km = response.data.km;
          that.cor = response.data.color;
          that.image = response.data.image;
          that.detail = response.data.detail;
          that.$bvModal.show("bv-modal-car");
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    buscar(id) {
      var that = this;
      axios
        .get("http://workshop.innovaweb.com.br/cars/" + id)
        .then(function (response) {
          console.log(response);
          that.uniq_car = response.data;
          that.$bvModal.show("bv-modal-uniq-car");
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    deletar(id) {
      var that = this;

      axios
        .delete("http://workshop.innovaweb.com.br/cars/" + id)
        .then(function (response) {
          console.log(response);
          that.getCars();
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    editar() {
      var that = this;

      var data = {
        name: this.nome,
        brand: this.marca,
        km: this.km,
        image: this.image,
        color: this.cor,
        details: this.detail,
      };

      axios
        .put("http://workshop.innovaweb.com.br/cars/" + this.edit_car, data)
        .then(function (response) {
          console.log(response);
          that.$bvModal.hide("bv-modal-car");
          that.getCars();
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    cadastrar() {
      var that = this;

      this.edit_car = null;

      var data = {
        name: this.nome,
        brand: this.marca,
        km: this.km,
        image: this.image,
        color: this.cor,
        details: this.detail,
      };

      axios
        .post("http://workshop.innovaweb.com.br/cars", data)
        .then(function (response) {
          console.log(response);
          that.$bvModal.hide("bv-modal-car");
          that.getCars();
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    getCars() {
      var that = this;
      this.loading = true;
      axios
        .get("http://workshop.innovaweb.com.br/cars")
        .then(function (response) {
          console.log(response);
          var cars = response.data;
          for (let i = 0; i < cars.length; i++) {
            cars[i].actions = true;
          }
          that.items = response.data;
          that.loading = false;
        })
        .catch(function (error) {
          console.log(error);
        });
    },
  },
  mounted() {
    this.getCars();
  },
  created(){
    this.$router.push('/about')
    console.log('about')
  }
};
</script>

<style>
.home {
  width: 90%;
  margin: 0 auto;
  margin-top: 30px;
}

.pointer {
  cursor: pointer;
}

.space-btn {
  margin-left: 10px;
  margin-right: 10px;
}
</style>
